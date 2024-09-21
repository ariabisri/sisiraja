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
            'uploader' => 'required',
            'banner' => 'required',
            'published_at' => 'nullable|date',
            'status' => 'required|in:draft,published',
        ]);

        $fileName = time() . '_' . $request->file('banner')->getClientOriginalName();
        $filePath = $request->file('banner')->storeAs('uploads', $fileName, 'public');

        // Menyimpan artikel ke database
        $artikel = Artikel::create([
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,
            'uploader' => $request->uploader,
            'banner' => '/storage/' . $filePath,
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
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'author' => 'required',
            'uploader' => 'required',
            'banner' => 'nullable|image', // nullable jika tidak ingin mengganti banner
            'published_at' => 'nullable|date',
            'status' => 'required|in:draft,published',
        ]);

        // Mendapatkan artikel yang akan di-update
        $artikel = Artikel::findOrFail($id);

        // Mengupdate banner jika ada file baru yang di-upload
        if ($request->hasFile('banner')) {
            $fileName = time() . '_' . $request->file('banner')->getClientOriginalName();
            $filePath = $request->file('banner')->storeAs('uploads', $fileName, 'public');
            $artikel->banner = '/storage/' . $filePath;
        }

        // Update data lainnya ke database
        $artikel->update([
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,
            'uploader' => $request->uploader,
            'published_at' => $request->published_at,
            'status' => $request->status,
        ]);

        return redirect()->route('artikels.index')->with('success', 'Artikel berhasil diperbarui!');
    }


    // Menghapus artikel dari database
    public function destroy(artikel $artikel)
    {
        $artikel->delete();
        return redirect()->route('artikels.index');
    }
}
