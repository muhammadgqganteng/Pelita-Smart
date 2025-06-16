<?php

namespace App\Http\Controllers\Murid;

use App\Models\Soal;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Tugas1Controller extends Controller 
{
    public function index()
{
    $tugas = Tugas::with('soalTugas')->latest()->get();
    return view('murid.tugas.index', compact('tugas'));
}

public function show(Tugas $tugas)
{
    $soals = $tugas->soalTugas->map->bankSoal;
    return view('murid.tugas.show', compact('tugas', 'soals'));
}

public function submit(Request $request, Tugas $tugas)
{
    $murid = Auth::user();
    $muridId = $murid->id;

    try {
        DB::beginTransaction();

        $totalSkorTugas = $tugas->soal->sum('skor');

        $hasilTugas = HasilTugas::create([
            'user_id' => $muridId,
            'tugas_id' => $tugas->id,
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
        $skorDiperolehOtomatis = 0;

        $soalTugas = $tugas->soal()->with('pilihanJawaban')->get();

        foreach ($soalTugas as $soal) {
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
            }

            $skorDiperolehOtomatis += ($scoreObtainedPerSoal ?? 0);

            JawabanTugas::create([
                'hasil_tugas_id' => $hasilTugas->id,
                'user_id' => $muridId,
                'tugas_id' => $tugas->id,
                'soal_id' => $soal->id,
                'pilihan_id' => $pilihanId,
                'jawaban_isian' => $jawabanIsian,
                'pasangan_jawaban' => $pasanganJawaban,
                'is_correct' => $isCorrect,
                'score_obtained' => $scoreObtainedPerSoal,
                'correct_answer_text' => $correctAnswerText,
            ]);
        }

        $hasilTugas->jumlah_benar = $jumlahBenar;
        $hasilTugas->jumlah_salah = $jumlahSalah;
        $hasilTugas->nilai_otomatis = ($totalSkorTugas > 0) ? ($skorDiperolehOtomatis / $totalSkorTugas) * 100 : 0;
        $hasilTugas->nilai_akhir = $hasilTugas->nilai_otomatis;
        $hasilTugas->save();

        DB::commit();

        return redirect()->route('murid.tugas.hasil', $hasilTugas->id)
                         ->with('success', 'Tugas berhasil disubmit!');
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Error submitting tugas: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Terjadi kesalahan saat submit tugas.');
    }
}



}
