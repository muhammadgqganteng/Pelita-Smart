<?php
namespace App\Http\Controllers\Admin;

use App\Models\Ebook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EbookController extends Controller
{
    public function index()
    {
        $ebooks = Ebook::latest()->get();
        return view('admin.ebooks.index', compact('ebooks'));
    }

    public function create()
    {
        return view('admin.ebooks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'cover_image' => 'required|image',
            'file' => 'required|mimes:pdf',
            'description' => 'nullable|string'
        ]);

        $cover = $request->file('cover_image')->store('covers','public');
        $pdf = $request->file('file')->store('ebooks','public');

        Ebook::create([
            'title' => $request->title,
            'cover_image' => $cover,
            'file' => $pdf,
            'description' => $request->description
        ]);

        return redirect()->route('admin.ebooks.index')->with('success', 'Ebook berhasil ditambahkan.');
    }

    public function edit(Ebook $ebook)
    {
        return view('admin.ebooks.edit', compact('ebook'));
    }

    public function update(Request $request, Ebook $ebook)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'cover_image' => 'image',
            'file' => 'mimes:pdf'
        ]);

        if ($request->hasFile('cover_image')) {
            $ebook->cover_image = $request->file('cover_image')->store('covers');
        }

        if ($request->hasFile('file')) {
            $ebook->file = $request->file('file')->store('ebooks');
        }

        $ebook->update($request->only('title', 'description', 'cover_image', 'file'));

        return redirect()->route('admin.ebooks.index')->with('success', 'Ebook berhasil diupdate.');
    }

    public function destroy(Ebook $ebook)
    {
        $ebook->delete();
        return back()->with('success', 'Ebook berhasil dihapus.');
    }
}
