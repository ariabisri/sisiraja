<?php

namespace App\Http\Controllers;

use App\Models\artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    // Menampilkan daftar artikel
    public function index(Request $request)
    {
        // Menerima parameter pencarian dan sorting
        $search = $request->input('search');
        $sort = $request->input('sort', 'title'); // Default sort by 'title'
        $direction = $request->input('direction', 'asc'); // Default sort direction 'asc'

        // Mengambil artikel sesuai dengan pencarian dan sorting
        $artikels = Artikel::when($search, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('author', 'like', '%' . $search . '%');
        })
            ->orderBy($sort, $direction)
            ->get();

        // Mengirim data ke view
        return view('artikels.index', compact('artikels', 'sort', 'direction'));
    }


    // Menampilkan formulir untuk membuat artikel baru
    public function create()
    {
        return view('artikels.create');
    }

    // Menyimpan artikel baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'author' => 'required',
            'published_at' => 'nullable|date',
            'status' => 'required|in:draft,published',
        ]);

        // Menyimpan artikel ke database
        Artikel::create([
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,
            'published_at' => $request->published_at,
            'status' => $request->status,
        ]);

        return redirect()->route('artikels.index');
    }


    // Menampilkan artikel tertentu
    public function show(artikel $artikel)
    {
        return view('artikels.show', compact('artikel'));
    }

    // Menampilkan formulir untuk mengedit artikel
    public function edit(artikel $artikel)
    {
        return view('artikels.edit', compact('artikel'));
    }

    // Memperbarui artikel di database
    public function update(Request $request, artikel $artikel)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'author' => 'required',
            'published_at' => 'nullable|date',
            'status' => 'required|in:draft,published',
        ]);

        $artikel->update($request->all());
        return redirect()->route('artikels.index');
    }

    // Menghapus artikel dari database
    public function destroy(artikel $artikel)
    {
        $artikel->delete();
        return redirect()->route('artikels.index');
    }
}
