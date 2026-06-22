<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/feedback', [FeedbackController::class, 'index'])
    ->name('feedback.index');

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
Route::post('/feedback', [FeedbackController::class, 'store'])
    ->name('feedback.store');
