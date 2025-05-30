<?php

namespace App\Http\Controllers;

use App\Models\KotakSaran;
use Illuminate\Http\Request;

class KotakSaranController extends Controller
{
    /**
     * Menampilkan form kotak saran.
     */
    public function index()
    {
       $saran = KotakSaran::latest()->paginate(10);
        return view('murid.kotak_saran.index', compact('saran'));
    }

    /**
     * Menyimpan saran yang dikirimkan.
     */

    public function create()
    {
        return view('murid.kotak_saran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'isi_saran' => 'required|string',
        ]);
        KotakSaran::create($request->all());

        return redirect()->route('murid.kotak_saran.index')->with('success', 'Terima kasih atas saran Anda!');
    }
    public function show(KotakSaran $kotakSaran)
    {
        dd($kotakSaran);
        return view('murid.kotak_saran.show', compact('kotakSaran'));
    }

    /**
     * Menampilkan daftar semua saran (mungkin untuk admin).
      */
    // public function adminIndex()
    // {
    //     $saran = KotakSaran::latest()->paginate(10);
    //     return view('admin.kotak_saran.index', compact('saran'));
    // }

    /**
     * Menghapus saran (mungkin untuk admin).
     */
    public function destroy(KotakSaran $kotakSaran)
    {
        $kotakSaran->delete();
        return redirect()->route('murid.kotak-saran.index')->with('success', 'Saran berhasil dihapus.');
    }
}