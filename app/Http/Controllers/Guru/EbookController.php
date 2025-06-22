<?php

namespace App\Http\Controllers\Guru;

use App\Models\Ebook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EbookController extends Controller
{
    public function index()
    {
        $ebooks = Ebook::withCount('chapters')->latest()->get();
        return view('guru.ebooks.index', compact('ebooks'));
    }

    public function create()
    {
        return view('guru.ebooks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'cover_image' => 'required|image',
            'file' => 'required|mimes:pdf',
            'description' => 'nullable|string'
        ]);

        $cover = $request->file('cover_image')->store('covers');
        $pdf = $request->file('file')->store('ebooks');

        Ebook::create([
            'title' => $request->title,
            'cover_image' => $cover,
            'file' => $pdf,
            'description' => $request->description,
        ]);

        return redirect()->route('guru.ebooks.index')->with('success', 'Ebook berhasil ditambahkan.');
    }

    public function edit(Ebook $ebook)
    {
        return view('guru.ebooks.edit', compact('ebook'));
    }

    public function update(Request $request, Ebook $ebook)
    {
        $request->validate([
            'title' => 'required',
            'cover_image' => 'nullable|image',
            'file' => 'nullable|mimes:pdf',
            'description' => 'nullable|string'
        ]);

        if ($request->hasFile('cover_image')) {
            Storage::delete($ebook->cover_image);
            $ebook->cover_image = $request->file('cover_image')->store('covers');
        }

        if ($request->hasFile('file')) {
            Storage::delete($ebook->file);
            $ebook->file = $request->file('file')->store('ebooks');
        }

        $ebook->update($request->only('title', 'description'));

        return redirect()->route('guru.ebooks.index')->with('success', 'Ebook berhasil diperbarui.');
    }

    public function destroy(Ebook $ebook)
    {
        Storage::delete([$ebook->cover_image, $ebook->file]);
        $ebook->delete();
        return back()->with('success', 'Ebook berhasil dihapus.');
    }
}
