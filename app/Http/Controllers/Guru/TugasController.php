<?php

namespace App\Http\Controllers\Guru;

use App\Models\Soal;
use App\Models\Tugas;
use App\Models\Ujian;
use App\Models\BankSoal;
use App\Models\SoalTugas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $guruId = Auth::id(); // atau auth()->user()->id
    $tugas = Tugas::where('guru_id', auth::user()->id)->latest()->get();
    return view('guru.tugas.index', compact('tugas', 'guruId'));
}

public function create()
{
    // Ambil data bank soal yang dimiliki oleh guru
    $bankSoal = BankSoal::where('guru_id', auth::user()->id)->get(); // sesuaikan jika pakai guru_id
    return view('guru.tugas.create', compact('bankSoal'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'judul' => 'required',
        'deskripsi' => 'nullable',
        'tanggal_deadline' => 'nullable|date',
    ]);

    $validated['guru_id'] = auth::user()->id;

    $tugas = Tugas::create($validated);
    return redirect()->route('guru.tugas.index')->with('success', 'Tugas dibuat.');
}
public function edit(Tugas $tugas)
{
    return view('guru.tugas.edit', compact('tugas'));
}

public function update(Request $request, Tugas $tugas)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'tanggal_deadline' => 'nullable|date',
    ]);

    $tugas->update([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'tanggal_deadline' => $request->tanggal_deadline,
    ]);

    return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil diperbarui.');
}




public function show(Tugas $tugas)
{
    // $tugas->load('soal'); // 
    $bankSoals = BankSoal::where('guru_id', auth::user()->id)->get();
    return view('guru.tugas.show', compact('tugas', 'bankSoals'));
}

public function import(Request $request, Tugas $tugas)
{
    $request->validate([
        'bank_soal_ids' => 'required|array',
        'bank_soal_ids.*' => 'exists:bank_soals,id',
    ]);

    $bankSoals = BankSoal::whereIn('id', $request->bank_soal_ids)->get();

    foreach ($bankSoals as $bankSoal) {
        $soal = new Soal();
        $soal->tugas_id = $tugas->id; // → sekarang simpan ke tugas, bukan ujian
        $soal->kategori_soal_id = $bankSoal->kategori_soal_id;
        $soal->pertanyaan = $bankSoal->pertanyaan;
        $soal->jenis_soal = $bankSoal->jenis_soal;
        $soal->skor = $bankSoal->skor;
        $soal->waktu_pengerjaan = $bankSoal->waktu_pengerjaan;
        $soal->gambar_pertanyaan = $bankSoal->gambar_pertanyaan;
        $soal->save();

        // Jika soal PG, salin pilihan ganda
        if ($bankSoal->jenis_soal === 'pg') {
            foreach ($bankSoal->pilihanGanda as $pilihan) {
                $soal->pilihanGanda()->create([
                    'isi' => $pilihan->isi,
                    'is_correct' => $pilihan->is_correct,
                    'jawaban' => $pilihan->jawaban ?? null,
                ]);
            }
        }

        // Jika ada jenis soal lain, kamu bisa tambahkan logika di sini
    }

    return back()->with('success', 'Soal berhasil diimport ke tugas.');
}


public function destroy(Tugas $tugas)
{
    // Hapus semua soal yang terkait dengan tugas ini
    SoalTugas::where('tugas_id', $tugas->id)->delete();

    // Hapus tugas itu sendiri
    $tugas->delete();

    return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil dihapus.');
}

  
}
