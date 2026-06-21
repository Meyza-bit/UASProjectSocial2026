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

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [LoginController::class, 'showRegister'])->name('register');
    Route::post('/register', [LoginController::class, 'register']);
});

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