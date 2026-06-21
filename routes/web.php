<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\TransparansiController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Rute untuk Halaman Katalog Program Donasi (Versi Flat Tanpa Folder)
Route::get('/program', function () {
    $programs = DB::table('programs')->get();
    
    // Langsung mengarah ke file program.blade.php
    return view('program', compact('programs'));
})->name('program.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [LoginController::class, 'showRegister'])->name('register');
    Route::post('/register', [LoginController::class, 'register']);
});

// 2. Halaman Katalog Daftar Kebutuhan Barang kamu
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');

// 3. Halaman Form Input Pengiriman Barang (Buatan PM)
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');

// 4. Handler untuk memproses dan menyimpan data dari form saat disubmit
Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');

// ===== Modul Donasi =====
Route::get('/donasi/create', [DonasiController::class, 'create'])->name('donasi.create');

Route::get('/donasi/pembayaran', [DonasiController::class, 'pembayaran'])->name('donasi.pembayaran');

// Rute untuk memproses data dari form donasi (POST)
Route::post('/donasi/store', [DonasiController::class, 'store'])->name('donasi.store');

Route::post('/donasi/konfirmasi', [DonasiController::class, 'konfirmasi'])->name('donasi.konfirmasi');

// FIX: typo "pembayran" diperbaiki jadi "pembayaran-instruksi"
Route::get('/donasi/pembayaran-instruksi', [DonasiController::class, 'instruksi'])->name('donasi.instruksi');

// RUTE BARU: dipanggil saat user klik "Saya Sudah Melakukan Pembayaran"
Route::post('/donasi/selesai', [DonasiController::class, 'selesai'])->name('donasi.selesai');

// RUTE BARU: halaman terima kasih setelah bukti pembayaran berhasil diupload
Route::get('/donasi/terimakasih/{id}', [DonasiController::class, 'terimakasih'])->name('donasi.terimakasih');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/program', [ProgramController::class, 'index'])->name('program.index');

Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
Route::get('/donasi/form', [DonasiController::class, 'create'])->name('donasi.create');
Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store')->middleware('auth');
Route::get('/donasi/pembayaran', [DonasiController::class, 'pembayaran'])->name('donasi.pembayaran');
Route::get('/donasi/pembayaran-instruksi', [DonasiController::class, 'instruksi'])->name('donasi.instruksi');
Route::post('/donasi/selesai', [DonasiController::class, 'selesai'])->name('donasi.selesai');
Route::get('/donasi/terimakasih/{id}', [DonasiController::class, 'terimakasih'])->name('donasi.terimakasih');

Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');

Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store')->middleware('auth');
Route::get('/transparansi', [TransparansiController::class, 'index'])->name('transparansi');


Route::get('/transparansi', [TransparansiController::class, 'index'])->name('transparansi');
