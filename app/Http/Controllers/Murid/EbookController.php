<?php
namespace App\Http\Controllers\Murid;

use App\Models\Ebook;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EbookController extends Controller
{
    public function index()
    {
        return view('murid.eboks.index'); 
    }

    public function list()
    {
        return response()->json(Ebook::latest()->get());
    }

    public function show($id)
    {
        $ebook = Ebook::findOrFail($id);
        return view('murid.eboks.read', compact('ebook')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'cover_image' => 'required|image',
            'file' => 'required|mimes:pdf',
        ]);

        $cover = $request->file('cover_image')->store('covers');
        $pdf = $request->file('file')->store('ebooks');

        Ebook::create([
            'title' => $request->title,
            'cover_image' => $cover,
            'file' => $pdf,
            'description' => $request->description,
        ]);

        return response()->json(['message' => 'Ebook uploaded successfully!']);
    }
    public function apiList()
{
    $ebooks = Ebook::with('chapters')->latest()->get();
    return response()->json($ebooks);
}

}
