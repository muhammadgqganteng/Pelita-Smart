<?php

namespace App\Http\Controllers\Guru;

use App\Models\Soal;
use App\Models\Kelas;
use App\Models\Ujian;
use App\Models\BankSoal;
use App\Models\HasilUjian;


use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bankSoal = BankSoal::where('guru_id', auth::user()->id)->get(); 
    
        $ujians = Ujian::where('guru_id', auth::user()->id)->latest()->paginate(10);
        return view('guru.ujian.index', compact('ujians', 'bankSoal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mataPelajaran = MataPelajaran::all();
        $kelas = Kelas::all();
        return view('guru.ujian.create', compact('mataPelajaran', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_ujian' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal_mulai' => 'nullable|',//date_format:d-m-y H:i',
            'tanggal_selesai' => 'nullable|after:tanggal_mulai',//date_format:d-m-y H:i|after:tanggal_mulai',
            'waktu_ujian' => 'nullable|integer|min:1',
            'jumlah_soal' => 'nullable|integer|min:0',
            'jenis_ujian' => 'required|in:harian,uts,uas,lainnya',
            'status' => 'required|in:draft,aktif,selesai,arsipkan',
            'acak_soal' => 'nullable|boolean',
            'acak_jawaban' => 'nullable|boolean',
            'nilai_lulus' => 'nullable|integer|min:0',
            'instruksi_khusus' => 'nullable|string',
        ]);

        $ujian = Ujian::create([
            'guru_id' => Auth::user()->id,
            'nama_ujian' => $request->nama_ujian,
            'deskripsi' => $request->deskripsi,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'kelas_id' => $request->kelas_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'waktu_ujian' => $request->waktu_ujian,
            'jumlah_soal' => $request->jumlah_soal ?? 0,
            'jenis_ujian' => $request->jenis_ujian,
            'status' => $request->status,
            'acak_soal' => $request->acak_soal ?? false,
            'acak_jawaban' => $request->acak_jawaban ?? false,
            'nilai_lulus' => $request->nilai_lulus,
            'instruksi_khusus' => $request->instruksi_khusus,
        ]);

        return redirect()->route('guru.ujian.index')->with('success', 'Ujian berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ujian $ujian)
    {
        if ($ujian->guru_id !== auth::user()->id) {
            abort(403, 'Anda tidak memiliki akses ke ujian ini4.');
        }
        return view('guru.ujian.show', compact('ujian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ujian $ujian)
    {
        if ($ujian->guru_id !== auth::user()->id) {
            abort(403, 'Anda tidak memiliki akses ke ujian ini.');
        }
        $mataPelajaran = MataPelajaran::all();
        $kelas = Kelas::all();
        return view('guru.ujian.edit', compact('ujian', 'mataPelajaran', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ujian $ujian)
    {
        if ($ujian->guru_id !== auth::user()->id) {
            abort(403, 'Anda tidak memiliki akses ke ujian ini.');
        }

        $request->validate([
            'nama_ujian' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'mata_pelajaran_id' => 'required|exists:mata_pelajarans,id',
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal_mulai' => 'nullable|',//date_format:Y-m-d H:i,
            'tanggal_selesai' => 'nullable|after:tanggal_mulai',//date_format:Y-m-d H:i|after:tanggal_mulai',
            'waktu_ujian' => 'nullable|integer|min:1',
            'jumlah_soal' => 'nullable|integer|min:0',
            'jenis_ujian' => 'required|in:harian,uts,uas,lainnya',
            'status' => 'required|in:draft,aktif,selesai,arsipkan',
            'acak_soal' => 'nullable|boolean',
            'acak_jawaban' => 'nullable|boolean',
            'nilai_lulus' => 'nullable|integer|min:0',
            'instruksi_khusus' => 'nullable|string',
        ]);

        $ujian->update([
            'nama_ujian' => $request->nama_ujian,
            'deskripsi' => $request->deskripsi,
            'mata_pelajaran_id' => $request->mata_pelajaran_id,
            'kelas_id' => $request->kelas_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'waktu_ujian' => $request->waktu_ujian,
            'jumlah_soal' => $request->jumlah_soal ?? 0,
            'jenis_ujian' => $request->jenis_ujian,
            'status' => $request->status,
            'acak_soal' => $request->acak_soal ?? false,
            'acak_jawaban' => $request->acak_jawaban ?? false,
            'nilai_lulus' => $request->nilai_lulus,
            'instruksi_khusus' => $request->instruksi_khusus,
        ]);

        return redirect()->route('guru.ujian.index')->with('success', 'Ujian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy(Ujian $ujian)
    {
        if ($ujian->guru_id !== auth::user()->id) {
            abort(403, 'Anda tidak memiliki akses ke ujian ini.');
        }

        // Pertama, hapus semua pilihan jawaban yang terkait dengan soal-soal ujian ini
        foreach ($ujian->soal as $soal) {
            $soal->pilihanJawaban()->delete();
        }

        // Kemudian, hapus semua soal yang terkait dengan ujian ini
        $ujian->soal()->delete();

        // Terakhir, hapus hasil ujian yang terkait
        $ujian->hasilUjian()->delete();

        // Baru setelah itu, hapus ujiannya
        $ujian->delete();

        return redirect()->route('guru.ujian.index')->with('success', 'Ujian berhasil dihapus.');
    }
        public function importSoal(Request $request, Ujian $ujian)
    {
        // dd($request->bank_soal_ids);
        $request->validate([
            'bank_soal_ids' => 'required|array',
            'bank_soal_ids.*' => 'exists:bank_soals,id',
        ]);
        
        $bankSoals = BankSoal::whereIn('id', $request->bank_soal_ids)->get();

        foreach ($bankSoals as $bankSoal) {
            $soal = new Soal();
            $soal->ujian_id = $ujian->id;
            $soal->kategori_soal_id = $bankSoal->kategori_soal_id;
            $soal->pertanyaan = $bankSoal->pertanyaan;
            $soal->jenis_soal = $bankSoal->jenis_soal;
            $soal->skor = $bankSoal->skor;
            $soal->waktu_pengerjaan = $bankSoal->waktu_pengerjaan;
            $soal->gambar_pertanyaan = $bankSoal->gambar_pertanyaan;
            $soal->save();

            // Jika jenisnya PG, salin pilihan ganda dan jawaban
            if ($bankSoal->jenis_soal === 'pg') {
                        foreach ($bankSoal->pilihanGanda as $pilihan) {
                        $soal->pilihanGanda()->create([
                        'isi' => $pilihan->isi,
                        'is_correct' => $pilihan->is_correct,
                        'jawaban' => $pilihan->jawaban, 
]);

                }
            }

        }

        return back()->with('success', 'Soal berhasil diimport ke ujian.');
    }
// public function hasil(HasilUjian $hasilUjian)
//     {
//         dd($hasilUjian);
//         // $this->authorize('view', $hasilUjian); // jika pakai policy

//         $jawaban = \App\Models\JawabanSiswa::where('user_id', $hasilUjian->user_id)
//             ->where('ujian_id', $hasilUjian->ujian_id)
//             ->with('soal') // asumsi ada relasi soal di model
//             ->get();

//         return view('guru.ujian.hasil', [
//             'hasilUjian' => $hasilUjian,
//             'jawaban' => $jawaban,
//         ]);
//     }

}