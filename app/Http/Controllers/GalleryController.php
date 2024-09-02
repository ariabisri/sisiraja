<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri; // Model yang digunakan
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galeris = Galeri::all();
        return view('layouts.index', ['galeris' => $galeris]);
    }

    public function create()
    {
        return view('layouts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('galeri_images', 'public');

        Galeri::create([
            'title' => $validated['title'],
            'description' => $request->input('description'),
            'image_path' => $imagePath,
        ]);

        return redirect()->route('galeris.index')->with('success', 'Galeri created successfully.');
    }
    
    public function show(Galeri $galeri)
    {
        return view('layouts.show', compact('galeri'));
    }

    // Menampilkan halaman edit
    public function edit($id)
    {
        $gallery = Galeri::findOrFail($id);
        return view('layouts.edit', compact('gallery'));
    }

    // Menangani permintaan update
    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $galeri = Galeri::findOrFail($id);
    $galeri->title = $request->input('title');
    $galeri->description = $request->input('description');

    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($galeri->image_path) {
            Storage::disk('public')->delete($galeri->image_path);
        }
        // Simpan gambar baru
        $path = $request->file('image')->store('images', 'public');
        $galeri->image_path = $path;
    }

    $galeri->save();

    return redirect()->route('galleries.index')->with('success', 'Data updated successfully!');
}

    public function destroy(Galeri $galeri)
    {
        if ($galeri->image_path) {
            Storage::disk('public')->delete($galeri->image_path);
        }

        $galeri->delete();

        return redirect()->route('galeris.index')->with('success', 'Galeri deleted successfully.');
    }
}
