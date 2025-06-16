<?php

namespace App\Http\Controllers\Guru;

use App\Models\Soal;
use App\Models\Ujian;
use App\Models\BankSoal;
use Illuminate\Http\Request;
use App\Models\PilihanJawaban;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class SoalController extends Controller
{
    /**
     * Display a listing of the soal for a given ujian.
     */
    public function index(Ujian $ujian)
    {
    //  dd ($ujian);   
        $bankSoal = BankSoal::where('guru_id', auth::user()->id)->get(); // atau filter lain

    // return $ujian->guru_id;
            // Pastikan guru yang login adalah pemilik ujian

        if ($ujian->guru_id !== auth::user()->id) {
            abort(403, 'Anda tidak memiliki akses ke soal ujian ini test 1.');
        }

        $list_soal = Soal::where('ujian_id', $ujian->id)->with('pilihanJawaban')->paginate(10);
        return view('guru.soal.index', compact('ujian', 'list_soal', 'bankSoal'));
    }

    /**
     * Show the form for creating a new soal for a given ujian.
     */
    public function create(Ujian $ujian)
    {
        // Pastikan guru yang login adalah pemilik ujian
        if ($ujian->guru_id !== auth::user()->id) { 
            abort(403, 'Anda tidak memiliki akses untuk menambah soal di ujian ini test 2.');
        }

        return view('guru.soal.create', compact('ujian'));
    }
public function store(Request $request, Ujian $ujian)
{
    // Pastikan guru yang login adalah pemilik ujian
    if ($ujian->guru_id !== auth::user()->id) {
        abort(403, 'Anda tidak memiliki akses untuk menambah soal di ujian ini.');
    }

    $request->validate([
        'jenis_soal' => 'required|in:pg,esai',
        'pertanyaan' => 'required|string',
        'skor' => 'required|numeric|min:0',
        // 'pilihan' => 'required_if:jenis_soal,pg|array|min:2',
        // 'pilihan.*' => 'required_if:jenis_soal,pg|string', // Validasi setiap item di array pilihan adalah string
        'jawaban_benar' => 'required_if:jenis_soal,pg|nullable|numeric', // Pastikan jawaban_benar adalah key dari array pilihan
        
        
    ]);
//  dd('Data untuk soal esai:', $request->all());

    $soal = $ujian->soal()->create([
        'jenis_soal' => $request->jenis_soal,
        'pertanyaan' => $request->pertanyaan,
        'skor' => $request->skor,
    ]);

if ($request->jenis_soal === 'pg') {
    foreach ($request->pilihan as $key => $pilihan) {
        $benar = (strval($key) === $request->jawaban_benar);
        $soal->pilihanJawaban()->create([
            'jawaban' => $pilihan, 
            'benar' => $benar,
        ]);
    }
}

    return redirect()->route('guru.ujian.soal.index', $ujian->id)->with('success', 'Soal berhasil ditambahkan.');
}
    /**
     * Store a newly created soal in storage.
     */

    /**
     * Show the form for editing the specified soal.
     */
    public function edit(Ujian $ujian, Soal $soal)
    {
        // Pastikan guru yang login adalah pemilik ujian dan soal terkait
        if ($ujian->guru_id !== auth::user()->id || $soal->ujian_id !== $ujian->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit soal ini.');
        }

        $soal->load('pilihanJawaban');
        return view('guru.soal.edit', compact('ujian', 'soal'));
    }

   /**
     * Update the specified soal in storage.
     */
    public function update(Request $request, Ujian $ujian, Soal $soal)
    {
        // Pastikan guru yang login adalah pemilik ujian dan soal terkait
        if ($ujian->guru_id !== auth::user()->id || $soal->ujian_id !== $ujian->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit soal ini.');
        }

        $request->validate([
            'jenis_soal' => 'required|in:pg,esai',
            'pertanyaan' => 'required|string',
            'skor' => 'required|numeric|min:0',
            'pilihan' => 'required_if:jenis_soal,pg|array|min:2',
            'pilihan.*' => 'required_if:jenis_soal,pg|string',
            'jawaban_benar' => 'required_if:jenis_soal,pg|nullable|numeric',
        ]);

        $soal->update([
            'jenis_soal' => $request->jenis_soal,
            'pertanyaan' => $request->pertanyaan,
            'skor' => $request->skor,
        ]);

        if ($request->jenis_soal === 'pg') {
            // Hapus pilihan jawaban lama dan buat yang baru
            $soal->pilihanJawaban()->delete();
            foreach ($request->pilihan as $key => $pilihan) {
                $benar = (strval($key) === $request->jawaban_benar);
                $soal->pilihanJawaban()->create([
                    'jawaban' => $pilihan,
                    'benar' => $benar,
                ]);
            }
        }

        return redirect()->route('guru.ujian.soal.index', $ujian->id)->with('success', 'Soal berhasil diperbarui.');
    }
    /**
     * Remove the specified soal from storage.
     */
    public function destroy(Ujian $ujian, Soal $soal)
    {
        // Pastikan guru yang login adalah pemilik ujian dan soal terkait
        if ($ujian->guru_id !== auth::user()->id || $soal->ujian_id !== $ujian->id) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus soal ini.');
        }

        $soal->pilihanJawaban()->delete(); 
        $soal->delete();

        return redirect()->route('guru.ujian.soal.index', $ujian->id)->with('success', 'Soal berhasil dihapus.');
    }
    public function importSoal(Request $request, Ujian $ujian)
{
    $request->validate([
        'bank_soal_ids' => 'required|array',
        'bank_soal_ids.*' => 'exists:bank_soal,id',
    ]);

    $bankSoals = BankSoal::whereIn('id', $request->bank_soal_ids)->get();

    foreach ($bankSoals as $bank) {
        $ujian->soal()->create([
            'pertanyaan' => $bank->pertanyaan,
            'jenis_soal' => $bank->jenis_soal,
            'skor' => $bank->skor,
            'kategori_soal_id' => $bank->kategori_soal_id,
            'gambar_pertanyaan' => $bank->gambar_pertanyaan,
        ]);
    }

    return redirect()->back()->with('success', 'Soal berhasil diimpor dari Bank Soal.');
}
}