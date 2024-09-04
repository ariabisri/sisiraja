<?php

namespace App\Http\Controllers;

use App\Models\artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
        // Menampilkan daftar artikel
        public function index()
        {
            $artikels = artikel::all(); // Mengambil semua artikel dari database
            return view('artikel.index', compact('artikels')); // Mengirim data ke view
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
            ]);

            artikel::create($request->all());
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

