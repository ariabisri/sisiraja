<?php

use App\Http\Controllers\ArtikelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/index', [HomeController::class, 'index'])->name('index');

Route::get('/create', [HomeController::class, 'create'])->name('create');

Route::post('/store', [HomeController::class, 'store'])->name('store');

Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('edit');
Route::put('/update/{id}', [HomeController::class, 'update'])->name('update');
Route::delete('/delete/{id}', [HomeController::class, 'delete'])->name('delete');


Route::get('home', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');


Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');


Route::resource('artikels', ArtikelController::class);
Route::get('artikels/{id}', [ArtikelController::class, 'show'])->name('artikels.show');


