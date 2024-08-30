<?php

use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('galeris', GalleryController::class);

// Route untuk menampilkan halaman edit
Route::get('/galeris/{id}/edit', [GalleryController::class, 'edit'])->name('edit');

// Route untuk menangani pembaruan data
Route::put('/galeris/{id}/update', [GalleryController::class, 'update'])->name('update');

//route kembali dari halaman update
Route::get('/', [GalleryController::class, 'index'])->name('home');

