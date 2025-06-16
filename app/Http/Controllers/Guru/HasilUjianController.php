<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Ujian;
use App\Models\HasilUjian; 
use App\Models\User;       // Pastikan ini di-import jika Anda mengakses user details
use Illuminate\Support\Facades\Auth; // Pastikan ini di-import
use Illuminate\Http\Request;

class HasilUjianController extends Controller
{
    /**
     * Biasanya, ini menampilkan daftar ujian yang dibuat guru, dengan link ke hasilnya.
     */
    public function index()
    {
        // Mengambil semua ujian yang dibuat oleh guru yang sedang login
        // Anda bisa tambahkan `withCount('hasilUjian')` jika ingin tahu berapa murid yang sudah submit
        $ujians = Ujian::where('guru_id', Auth::id())->latest()->get();

        // dd($ujians); // Debugging: pastikan daftar ujian muncul

        return view('guru.hasil.index', compact('ujians'));
    }

    /**
     * Display the hasil ujian for a specific ujian.
     * @param Ujian $ujian L
     */
    public function show(Ujian $ujian)
    {
        // if ($ujian->guru_id !== Auth::id()) {
        //     abort(403, 'Anda tidak memiliki akses untuk melihat hasil ujian ini.');
        // }

        // Mengambil semua record hasil ujian (dari tabel hasil_ujian) untuk ujian ini.
        // Eager load relasi 'murid' untuk mendapatkan data pengguna (nama murid).
        // Gunakan paginate untuk data yang banyak.
        $hasilUjianMurid = HasilUjian::where('ujian_id', $ujian->id)
                                    ->with('murid') // Memuat relasi 'murid'
                                    ->latest('waktu_selesai') // Urutkan berdasarkan waktu selesai terbaru
                                    ->paginate(10);

        // Hapus dd() ini setelah Anda yakin datanya sudah benar
        // dd([
        //     'ujian' => $ujian,
        //     'hasil_ujian_murid_data' => $hasilUjianMurid->toArray() // Menggunakan toArray() untuk melihat data pagination
        // ]);

        // Mengirim data ke view
        return view('guru.hasil.show', compact('ujian', 'hasilUjianMurid')); // Pastikan nama variabel sesuai di view
    }

    // Anda bisa tambahkan method untuk melihat detail jawaban per murid
    // public function detailHasilMurid(Ujian $ujian, HasilUjian $hasilUjianRecord) {
    //     // ... logika untuk menampilkan detail jawaban satu murid
    // }
}