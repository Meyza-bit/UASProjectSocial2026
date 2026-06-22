<?php

use App\Http\Controllers\Api\ProgramController;
use App\Http\Controllers\Api\DonasiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes (Papan Penunjuk Arah API)
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. KELOMPOK ENDPOINT PROGRAM DONASI
// ==========================================

// Menampilkan semua list program donasi yang aktif
Route::get('/program', [ProgramController::class, 'index']);

// Menampilkan detail informasi dari satu program saja berdasarkan ID-nya
Route::get('/program/{id}', [ProgramController::class, 'show']);

// Memfilter program donasi berdasarkan kategori tertentu (misal: bencana, pendidikan)
Route::get('/program/kategori/{kategori}', [ProgramController::class, 'filterKategori']);

// Menampilkan daftar target penerima donasi yang aktif
Route::get('/target-penerima', [ProgramController::class, 'targetPenerima']);


// ==========================================
// 2. KELOMPOK ENDPOINT TRANSAKSI DONASI
// ==========================================

// Menampilkan seluruh riwayat transaksi donasi uang yang sudah diverifikasi (sukses)
Route::get('/donasi', [DonasiController::class, 'index']);

// Jalur khusus untuk mengirim transaksi baru yang WAJIB LOGIN (Menggunakan token Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    
    // Menyimpan data kiriman donasi uang baru dari user ke database
    Route::post('/donasi/dana', [DonasiController::class, 'storeDana']);
    
});