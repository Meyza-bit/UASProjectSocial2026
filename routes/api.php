<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProgramController;
use App\Http\Controllers\Api\DonasiController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\TransparansiController;

// ============================================================
// ROUTE PUBLIK (tidak perlu login)
// ============================================================

// Program Donasi
Route::get('/program', [ProgramController::class, 'index']);
Route::get('/program/{id}', [ProgramController::class, 'show']);
Route::get('/program/kategori/{kategori}', [ProgramController::class, 'filterKategori']);
Route::get('/target-penerima', [ProgramController::class, 'targetPenerima']);

// Donasi
Route::get('/donasi', [DonasiController::class, 'index']);

// Feedback
Route::get('/feedback', [FeedbackController::class, 'index']);

// Transparansi
Route::get('/transparansi', [TransparansiController::class, 'index']);

// ============================================================
// ROUTE PROTECTED (perlu login - Sanctum)
// ============================================================
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/donasi/dana', [DonasiController::class, 'storeDana']);
    Route::post('/donasi/barang', [DonasiController::class, 'storeBarang']);
    Route::post('/feedback', [FeedbackController::class, 'store']);
});