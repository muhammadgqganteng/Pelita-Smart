<?php

namespace App\Http\Controllers\Guru;

use App\Models\Ebook;
use App\Models\Chapter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChapterController extends Controller
{
    public function index(Ebook $ebook)
    {
        $chapters = $ebook->chapters()->latest()->get();
        return view('guru.chapters.index', compact('ebook', 'chapters'));
    }

    public function create(Ebook $ebook)
    {
        return view('guru.chapters.create', compact('ebook'));
    }

    public function store(Request $request, Ebook $ebook)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        $ebook->chapters()->create([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect()->route('guru.ebooks.chapters.index', $ebook)->with('success', 'Bab berhasil ditambahkan.');
    }

    public function edit(Ebook $ebook, Chapter $chapter)
    {
        return view('guru.chapters.edit', compact('ebook', 'chapter'));
    }

    public function update(Request $request, Ebook $ebook, Chapter $chapter)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        $chapter->update($request->only('title', 'content'));

        return redirect()->route('guru.ebooks.chapters.index', $ebook)->with('success', 'Bab berhasil diperbarui.');
    }

    public function destroy(Ebook $ebook, Chapter $chapter)
    {
        $chapter->delete();
        return back()->with('success', 'Bab berhasil dihapus.');
    }
}
