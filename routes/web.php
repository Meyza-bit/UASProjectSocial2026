<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BarangController;

// 1. Halaman Beranda Utama Laravel 13
Route::get('/', function () {
    return view('welcome');
});

// 2. Halaman Katalog Daftar Kebutuhan Barang kamu
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');

// 3. Halaman Form Input Pengiriman Barang (Buatan PM)
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');

<<<<<<< HEAD
// 4. Handler untuk memproses dan menyimpan data dari form saat disubmit
Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');

Route::get('/barang/sukses/{id}', [BarangController::class, 'sukses'])->name('barang.sukses');
=======
// 4. Handler utuk memproses dan menyimpan data dari form saat disubmit
Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\TransparansiController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/program', [ProgramController::class, 'index'])->name('program.index');
Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
Route::get('/donasi/form', [DonasiController::class, 'create'])->name('donasi.create');
Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store')->middleware('auth');
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/form', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store')->middleware('auth');
Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store')->middleware('auth');
Route::get('/transparansi', [TransparansiController::class, 'index'])->name('transparansi');

>>>>>>> f67ae15aa39730917369851a1f1c2fd5e4a86b14
