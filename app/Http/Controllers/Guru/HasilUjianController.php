<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Ujian;
use App\Models\HasilUjian;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class HasilUjianController extends Controller
{
    /**
     * Display a listing of the hasil ujian.
     */
    public function index()
    {
        
        $ujians = Ujian::where('guru_id', auth::user()->id)->latest()->get();


        return view('guru.hasil-ujian.index', compact('ujian'));
    }

    /**
     * Display the hasil ujian for a specific ujian.
     */
    public function show(Ujian $ujian)
    {
    
        if ($ujian->guru_id !== auth::user()->id) {
            abort(403, 'Anda tidak memiliki akses ke hasil ujian ini.');
        }

        
        $hasilUjian = HasilUjian::where('ujian_id', $ujian->id)
            ->with('siswa') /
            ->latest()
            ->paginate(10);

        return view('guru.hasil-ujian.show', compact('ujian', 'hasilUjian'));
    }

}