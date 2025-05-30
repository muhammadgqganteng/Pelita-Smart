<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Ujian;
use App\Models\MataPelajaran;
use App\Models\Kelas;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ujians = Ujian::where('guru_id', auth::user()->id)->latest()->paginate(10);
        return view('guru.ujian.index', compact('ujians'));
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
}