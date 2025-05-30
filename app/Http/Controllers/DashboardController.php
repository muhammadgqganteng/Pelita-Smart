<?php

namespace App\Http\Controllers;


// use App\Models\HasilUjian;
use Illuminate\Http\Request;
use App\Models\Ujian; // Pastikan Anda mengimpor model Ujian Anda
use App\Models\HasilUjian; // Pastikan Anda mengimpor model HasilUjian Anda


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function guruDashboard()
    {
        return view('guru.dashboard');
    }

    public function muridDashboard()
    {
        $murid = Auth::user(); // Mendapatkan user yang sedang login

        // Mengambil semua hasil ujian yang telah dikerjakan oleh murid ini
        $ujianTerlaksanaData = HasilUjian::where('user_id', $murid->id)->get();

        // Hitung jumlah ujian yang sudah terlaksana
        $ujianTerlaksana = $ujianTerlaksanaData->count();

        // Mengambil semua ID ujian yang sudah terlaksana oleh murid ini
        $ujianIdsTerlaksana = $ujianTerlaksanaData->pluck('ujian_id')->toArray();

        // Mengambil semua ujian yang tersedia (misalnya, yang berstatus 'aktif' atau 'published')
        // Sesuaikan dengan kolom status atau kriteria ujian yang ingin Anda hitung
        $semuaUjianAktif = Ujian::where('status', 'published')->get(); // Contoh: hanya hitung ujian yang statusnya 'published'
        $semuaUjian = Ujian::count();
        // Hitung jumlah ujian yang belum terlaksana
        // Yaitu ujian yang ada di $semuaUjianAktif tapi ID-nya tidak ada di $ujianIdsTerlaksana
        $ujianBelumTerlaksana = $semuaUjianAktif->whereNotIn('id', $ujianIdsTerlaksana)->count();

        return view('murid.dashboard', compact('ujianTerlaksana', 'ujianBelumTerlaksana', 'semuaUjian'));
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function redirectToRoleDashboard()
    {
        $user = Auth::user();
        if ($user->role === 'guru') {
            return redirect()->route('guru.dashboard');
        } elseif ($user->role === 'murid') {
            return redirect()->route('murid.dashboard');
        } elseif ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            // Handle kasus jika peran tidak terdefinisi
            abort(403, 'Akses ditolak.');
        }
    }
}