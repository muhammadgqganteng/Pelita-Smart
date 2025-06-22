<?php
namespace App\Http\Controllers\Admin;

use App\Models\Ebook;
use App\Models\Chapter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChapterController extends Controller
{
    public function index(Ebook $ebook)
    {
        $chapters = $ebook->chapters;
        return view('admin.chapters.index', compact('ebook', 'chapters'));
    }

    public function create(Ebook $ebook)
    {
        return view('admin.chapters.create', compact('ebook'));
    }

    public function store(Request $request, Ebook $ebook)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $ebook->chapters()->create($request->only('title', 'content'));

        return redirect()->route('admin.ebooks.chapters.index', $ebook)->with('success', 'Chapter berhasil ditambahkan.');
    }

    public function edit(Ebook $ebook, Chapter $chapter)
    {
        return view('admin.chapters.edit', compact('ebook', 'chapter'));
    }

    public function update(Request $request, Ebook $ebook, Chapter $chapter)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $chapter->update($request->only('title', 'content'));

        return redirect()->route('admin.ebooks.chapters.index', $ebook)->with('success', 'Chapter berhasil diperbarui.');
    }

    public function destroy(Ebook $ebook, Chapter $chapter)
    {
        $chapter->delete();
        return back()->with('success', 'Chapter berhasil dihapus.');
    }
}
