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
        return view('index', ['galeris' => $galeris]);
    }

    public function create()
    {
        return view('create');
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
        return view('edit', compact('gallery'));
    }

    // Menangani permintaan update
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);        

        $gallery = Galeri::findOrFail($id);
        $gallery->name = $request->input('name');

        if ($request->hasFile('image')) {
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $imagePath = $request->file('image')->store('galleries', 'public');
            $gallery->image_path = $imagePath;
        }

        $gallery->save();
        dd($gallery);

        return redirect()->route('galeris.edit')->with('success', 'Gallery updated successfully');
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
