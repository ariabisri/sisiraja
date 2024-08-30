<?php

use App\Http\Controllers\ArtikelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('artikels', ArtikelController::class);
Route::get('artikels/{id}', [ArtikelController::class, 'show'])->name('artikels.show');


