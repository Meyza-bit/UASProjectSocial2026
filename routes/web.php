<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DonasiController;

Route::get('/', function () {
    return view('welcome');
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
