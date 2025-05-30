<?php

namespace App\Http\Controllers\Murid;

use App\Models\Soal;
use App\Models\Ujian;
use App\Models\HasilUjian;
use App\Models\JawabanSiswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class Ujian2Controller extends Controller
{
    /**
     * Display a listing of the available ujian for the murid.
     */
    public function index()
    {
        $murid = Auth::user(); // Mendapatkan informasi murid yang login    

        $ujian = Ujian::where('kelas_id', $murid->kelas_id)->get();
        

        // Ambil ujian yang aktif, ditujukan untuk kelas murid, dan dalam rentang waktu yang sesuai
        // $ujian = Ujian::where('status', 'aktif')
        //     ->where('kelas_id', $murid->kelas_id) // Asumsi model User m    emiliki relasi ke Kelas (kelas_id)
        //     ->where(function ($query) {
        //         $now = now();
        //         $query->whereNull('tanggal_mulai')
        //             ->orWhere('tanggal_mulai', '<=', $now);
        //     })
        //     ->where(function ($query) {
        //         $now = now();
        //         $query->whereNull('tanggal_selesai')
        //             ->orWhere('tanggal_selesai', '>=', $now);
        //     })
        //     ->latest('tanggal_mulai')
        //     ->get();
            // dd($ujian);

        return view('murid.ujian.index', compact('ujian'));
    }

    /**
     * Show the form for mengerjakan the specified ujian.
     */
    public function show(Ujian $ujian)
    {
                $murid = Auth::user();
        $hasilSudahAda = HasilUjian::where('ujian_id', $ujian->id)
                                    ->where('user_id', $murid->id)
                                    ->exists();

        if ($hasilSudahAda) {
            $hasil = HasilUjian::where('ujian_id', $ujian->id)
                                ->where('user_id', $murid->id)
                                ->first();
            return redirect()->route('murid.ujian.hasil', $hasil->id)->with('warning', 'Anda sudah menyelesaikan ujian ini.');
        }
        // Periksa apakah murid terdaftar di kelas ujian ini dan ujian sedang aktif
        $murid = Auth::user();
        $now = now();

        if ($ujian->status !== 'aktif' || $ujian->kelas_id !== $murid->kelas_id ||
            ($ujian->tanggal_mulai && $ujian->tanggal_mulai > $now) ||
            ($ujian->tanggal_selesai && $ujian->tanggal_selesai < $now)) {
        }   

         $soalList = $ujian->soal->map(function ($soal) {
        return [
            'id' => $soal->id,
            'pertanyaan' => $soal->pertanyaan,
            'jenis_soal' => $soal->jenis_soal,
            'pilihan' => $soal->jenis_soal === 'pg'
                ? $soal->pilihanJawaban->shuffle()->values()->map(function ($p) {
                    return [
                        'id' => $p->id,
                        'jawaban' => $p->jawaban
                    ];
                })
                : [],
        ];
    });
  

        $soal = $ujian->soal()->with('pilihanJawaban')->inRandomOrder()->get(); // Ambil soal dan pilihan (jika ada) secara acak

        return view('murid.ujian.show', compact('ujian', 'soal', 'soalList'));
    }

    /**
     * Store the murid's answers for the specified ujian.
     */
    
   public function submit(Request $request, Ujian $ujian)
    {
        $murid = Auth::user();
        $muridId = $murid->id;

        // ... (Validasi akses dan double submit) ...

        try {
            DB::beginTransaction();

            $totalSkorUjian = $ujian->soal->sum('skor');

            $hasilUjian = HasilUjian::create([
                'user_id' => $muridId,
                'ujian_id' => $ujian->id,
                'waktu_mulai' => now(),
                'waktu_selesai' => now(),
                'status' => 'selesai',
                'nilai_otomatis' => 0,
                'nilai_esai' => 0,
                'nilai_akhir' => 0,
                'jumlah_benar' => 0,
                'jumlah_salah' => 0,
            ]);

            $jumlahBenar = 0;
            $jumlahSalah = 0;
            $skorDiperolehOtomatis = 0; // Ini adalah variabel lokal untuk perhitungan

            $soalUjian = $ujian->soal()->with('pilihanJawaban')->get();

            foreach ($soalUjian as $soal) {
                // $jawabanMuridInput = $request->input('jawaban_soal.' . $soal->id);
                $jawabanMuridInput = $request->input('jawaban.' . $soal->id);

                $pilihanId = null;
                $jawabanIsian = null;
                $pasanganJawaban = null;
                $isCorrect = null;
                $scoreObtainedPerSoal = null;
                $correctAnswerText = null;

                switch ($soal->jenis_soal) {
                    case 'pg':
                        $pilihanId = $jawabanMuridInput;
                        $pilihanBenar = $soal->pilihanJawaban->where('benar', true)->first();
                        


                        // //         // Debugging: Lihat nilai-nilai kunci ini
                        // dd([
                        //     'soal_id' => $soal->id,
                        //     'jawaban_murid_input' => $jawabanMuridInput, // Apa yang dikirim dari form
                        //     'pilihan_id_murid' => $pilihanId,           // Nilai yang digunakan untuk perbandingan
                        //     'pilihan_benar_dari_db' => $pilihanBenar,    // Objek pilihan yang benar dari DB
                        //     'id_pilihan_benar_dari_db' => $pilihanBenar ? $pilihanBenar->id : 'Tidak ada pilihan benar',
                        //     'perbandingan_string' => (string) $pilihanId === (string) ($pilihanBenar ? $pilihanBenar->id : ''),
                        // ]);

                        if ($pilihanBenar) {
                            $correctAnswerText = $pilihanBenar->jawaban;
                            if ((string) $pilihanId === (string) $pilihanBenar->id) {
                                $isCorrect = true;
                                $scoreObtainedPerSoal = $soal->skor;
                                $jumlahBenar++;
                            } else {
                                $isCorrect = false;
                                $scoreObtainedPerSoal = 0;
                                $jumlahSalah++;
                            }
                        } else {
                            $isCorrect = false;
                            $scoreObtainedPerSoal = 0;
                        }
                        break;
                    case 'esai':
                    case 'isian':
                        $jawabanIsian = $jawabanMuridInput;
                        break;
                    case 'menjodohkan':
                        $pasanganJawaban = is_array($jawabanMuridInput) ? json_encode($jawabanMuridInput) : null;
                        break;
                    default:
                        break;
                }

                $skorDiperolehOtomatis += ($scoreObtainedPerSoal ?? 0);

                JawabanSiswa::create([
                    'hasil_ujian_id' => $hasilUjian->id,
                    'user_id' => $muridId,
                    'ujian_id' => $ujian->id,
                    'soal_id' => $soal->id,
                    'pilihan_id' => $pilihanId,
                    'jawaban_isian' => $jawabanIsian,
                    'pasangan_jawaban' => $pasanganJawaban,
                    'is_correct' => $isCorrect,
                    'score_obtained' => $scoreObtainedPerSoal,
                    'correct_answer_text' => $correctAnswerText,
                ]);
            }

            // --- INI BAGIAN PENTING YANG MENYESUAIKAN DENGAN MIGRASI ANDA ---
            $hasilUjian->jumlah_benar = $jumlahBenar;
            $hasilUjian->jumlah_salah = $jumlahSalah;
            $hasilUjian->nilai_otomatis = ($totalSkorUjian > 0) ? ($skorDiperolehOtomatis / $totalSkorUjian) * 100 : 0;
            $hasilUjian->nilai_akhir = $hasilUjian->nilai_otomatis; // Anda bisa sesuaikan ini nanti
            // nilai_esai tetap 0 karena dinilai manual

            $hasilUjian->save(); // Simpan perubahan

            DB::commit();

            return redirect()->route('murid.ujian.hasil',$hasilUjian->id)
                             ->with('success', 'Jawaban berhasil dikumpulkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error submitting exam for murid ' . $muridId . ': ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan jawaban Anda. Silakan coba lagi.')->withErrors(['error' => $e->getMessage()]);
        }
    }


        /**
         * Show the result for the specified ujian.
         */
    public function hasil(HasilUjian $hasilUjian)
    {
        // $this->authorize('view', $hasilUjian); // jika pakai policy

        $jawaban = \App\Models\JawabanSiswa::where('user_id', $hasilUjian->user_id)
            ->where('ujian_id', $hasilUjian->ujian_id)
            ->with('soal') // asumsi ada relasi soal di model
            ->get();

        return view('murid.ujian.hasil', [
            'hasilUjian' => $hasilUjian,
            'jawaban' => $jawaban,
        ]);
    }
}
