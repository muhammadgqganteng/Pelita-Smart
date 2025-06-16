<?php

namespace App\Http\Controllers\Guru;

use App\Models\BankSoal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BankSoalController extends Controller
{
    /**
     * Tampilkan semua soal milik guru yang sedang login.
     */
    public function index()
    {
        $soals = BankSoal::with('pilihanJawaban')
            ->where('guru_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('guru.bank_soal.index', compact('soals'));
    }

    /**
     * Tampilkan form tambah soal.
     */
    public function create()
    {
        return view('guru.bank_soal.create');
    }

    /**
     * Simpan soal baru ke database.
     */
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
            'guru_id' => Auth::id(),
            'jenis_soal' => $data['jenis_soal'],
            'pertanyaan' => $data['pertanyaan'],
            'skor' => $data['skor'],
        ]);

        // Jika soal PG, tambahkan pilihan jawaban
        if ($data['jenis_soal'] === 'pg') {
            foreach ($data['pilihan'] as $index => $teksJawaban) {
                $soal->pilihanJawaban()->create([
                    'jawaban' => $teksJawaban,
                    'benar' => strval($index) === $data['jawaban_benar'],
                ]);
            }
        }

        return redirect()
            ->route('guru.banksoal.index')
            ->with('success', 'Soal berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit soal.
     */
    public function edit(BankSoal $soal)
    {
        // Pastikan soal milik guru yang sedang login
        $this->authorizeSoal($soal);
        $soal->load('pilihanJawaban');

        return view('guru.bank_soal.edit', compact('soal'));
    }

    /**
     * Update data soal.
     */
    public function update(Request $request, BankSoal $soal)
    {
        $this->authorizeSoal($soal);

        $data = $request->validate([
            'jenis_soal' => 'required|in:pg,esai',
            'pertanyaan' => 'required|string',
            'skor' => 'required|numeric|min:0',
            'pilihan' => 'required_if:jenis_soal,pg|array|min:2',
            'pilihan.*' => 'required_if:jenis_soal,pg|string',
            'jawaban_benar' => 'required_if:jenis_soal,pg|nullable|numeric',
        ]);

        $soal->update([
            'jenis_soal' => $data['jenis_soal'],
            'pertanyaan' => $data['pertanyaan'],
            'skor' => $data['skor'],
        ]);

        // Update pilihan jawaban jika soal PG
        if ($data['jenis_soal'] === 'pg') {
            $soal->pilihanJawaban()->delete();

            foreach ($data['pilihan'] as $index => $teksJawaban) {
                $soal->pilihanJawaban()->create([
                    'jawaban' => $teksJawaban,
                    'benar' => strval($index) === $data['jawaban_benar'],
                ]);
            }
        }

        return redirect()
            ->route('guru.banksoal.index')
            ->with('success', 'Soal berhasil diperbarui.');
    }

    /**
     * Hapus soal.
     */
    public function destroy(BankSoal $soal)
    {
        $this->authorizeSoal($soal);

        $soal->pilihanJawaban()->delete(); // jika ada
        $soal->delete();

        return redirect()
            ->route('guru.banksoal.index')
            ->with('success', 'Soal berhasil dihapus.');
    }

    /**
     * Cek apakah soal dimiliki oleh guru yang sedang login.
     */
    protected function authorizeSoal(BankSoal $soal)
    {
        if ($soal->guru_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke soal ini.');
        }
    }
    
}
