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

// 4. Handler untuk memproses dan menyimpan data dari form saat disubmit
Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');

Route::get('/barang/sukses/{id}', [BarangController::class, 'sukses'])->name('barang.sukses');