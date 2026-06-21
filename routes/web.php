<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\TransparansiController;
use App\Http\Controllers\LoginController;

// Halaman Beranda / Utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Kelompok Rute untuk Pengguna yang BELUM Login (Guest)
Route::middleware('guest')->group(function () {
    // Jalur Halaman & Proses Login
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    // Jalur Halaman & Proses Daftar Akun (Register)
    Route::get('/register', [LoginController::class, 'showRegister'])->name('register');
    Route::post('/register', [LoginController::class, 'register']);
});

// Jalur Keluar Akun (Logout) - Harus Sudah Login (Auth)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Kelompok Rute Fitur Aplikasi MariBerbagi
Route::get('/program', [ProgramController::class, 'index'])->name('program.index');

// Fitur Donasi Dana
Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
Route::get('/donasi/form', [DonasiController::class, 'create'])->name('donasi.create');
Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store')->middleware('auth');

// Fitur Kirim Donasi Barang
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/form', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store')->middleware('auth');

// Fitur Feedback / Ulasan
Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store')->middleware('auth');

// Fitur Laporan Transparansi Dana & Barang
Route::get('/transparansi', [TransparansiController::class, 'index'])->name('transparansi.index');