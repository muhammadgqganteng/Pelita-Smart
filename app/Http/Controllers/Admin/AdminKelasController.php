<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminKelasController extends Controller
{
    /**

     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
      
        $kelas = Kelas::all();

        return view('admin.kelas.index', compact('kelas'));
    }

    /**
     * 
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.kelas.form');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari form
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas',
            'deskripsi' => 'nullable|string', 
        ]);

        Kelas::create($request->all());

        Session::flash('success', 'Kelas berhasil ditambahkan!');
        return redirect()->route('kelas.index');
    }

    /**
    
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\View\View
     */
    public function edit(Kelas $kelas)
    {
      
        return view('admin.kelas.form', compact('kelas'));
    }

    /**
  
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas,' . $kelas->id,
            'deskripsi' => 'nullable|string',
        ]);

    
        $kelas->update($request->all());

       
        Session::flash('success', 'Kelas berhasil diperbarui!');
        return redirect()->route('kelas.index');
    }

    /**
     
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Kelas $kelas)
    {
        
        $kelas->delete();

    
        Session::flash('success', 'Kelas berhasil dihapus!');
        return redirect()->route('kelas.index');
    }
}