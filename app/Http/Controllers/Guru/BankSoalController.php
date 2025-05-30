<?php

namespace App\Http\Controllers;

use App\Models\BankSoal;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class BankSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $soals = BankSoal::with('pilihanJawaban')->where('guru_id', auth()->id())->paginate(10);
    return view('guru.bank_soal.index', compact('soals'));
}

public function create()
{
    return view('guru.bank_soal.create');
}

public function store(Request $request)
{
    $data = $request->validate([
        'jenis_soal' => 'required|in:pg,esai',
        'pertanyaan' => 'required|string',
        'skor' => 'required|numeric|min:0',
        'pilihan' => 'required_if:jenis_soal,pg|array|min:2',
        'pilihan.*' => 'required_if:jenis_soal,pg|string',
        'jawaban_benar' => 'required_if:jenis_soal,pg|nullable|numeric',
    ]);

    $soal = BankSoal::create([
        'guru_id' => auth::user()->id,
        'jenis_soal' => $data['jenis_soal'],
        'pertanyaan' => $data['pertanyaan'],
        'skor' => $data['skor'],
    ]);

    if ($data['jenis_soal'] === 'pg') {
        foreach ($data['pilihan'] as $i => $pilihan) {
            $soal->pilihanJawaban()->create([
                'jawaban' => $pilihan,
                'benar' => (strval($i) === $data['jawaban_benar']),
            ]);
        }
    }

    return redirect()->route('guru.bank-soal.index')->with('success', 'Soal berhasil ditambahkan.');
}

}
