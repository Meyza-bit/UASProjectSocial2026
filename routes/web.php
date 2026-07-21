<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\TransparansiController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProgramDonasiController;
use App\Http\Controllers\Admin\PenyaluranDanaController;
use App\Http\Controllers\Admin\PenyaluranBarangController;
use App\Http\Controllers\Admin\PenyaluranController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// ===== Auth =====
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [LoginController::class, 'showRegister'])->name('register');
    Route::post('/register', [LoginController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ===== Modul Program =====
Route::get('/program', [ProgramController::class, 'index'])->name('program.index');

// ===== Modul Donasi =====
Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
Route::middleware(['auth', 'role:user,admin'])->group(function () {
    Route::get('/donasi/create/{program?}', [DonasiController::class, 'create'])->name('donasi.create');
    Route::post('/donasi/store', [DonasiController::class, 'store'])->name('donasi.store');
    Route::get('/donasi/pembayaran', [DonasiController::class, 'pembayaran'])->name('donasi.pembayaran');
    Route::get('/donasi/pembayaran-instruksi', [DonasiController::class, 'instruksi'])->name('donasi.instruksi');
    Route::post('/donasi/konfirmasi', [DonasiController::class, 'konfirmasi'])->name('donasi.konfirmasi');
    Route::post('/donasi/selesai', [DonasiController::class, 'selesai'])->name('donasi.selesai');
    Route::get('/donasi/terimakasih/{id}', [DonasiController::class, 'terimakasih'])->name('donasi.terimakasih');
});

// ===== Modul Barang =====
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::middleware(['auth', 'role:user,admin'])->group(function () {
    Route::get('/barang/create/{program?}', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/sukses/{id}', [BarangController::class, 'sukses'])->name('barang.sukses');
});

// ===== Modul Feedback =====
Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
Route::post('/feedback', [FeedbackController::class, 'store'])
    ->name('feedback.store')
    ->middleware(['auth', 'role:user,admin']);

// ===== Modul Transparansi =====
Route::get('/transparansi', [TransparansiController::class, 'index'])->name('transparansi');

// ===== Panel Admin =====
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Halaman Utama Admin (URL: localhost:8000/admin/dashboard)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Kelola Donasi Dana
    Route::get('/donasi-dana', [AdminController::class, 'donasiDana'])->name('donasi-dana');
    Route::post('/donasi-dana/{donasi}/verifikasi', [AdminController::class, 'verifikasiDonasi'])->name('donasi-dana.verifikasi');
    Route::post('/donasi-dana/{donasi}/tolak', [AdminController::class, 'tolakDonasi'])->name('donasi-dana.tolak');

    // Kelola Donasi Barang
    Route::get('/donasi-barang', [AdminController::class, 'donasiBarang'])->name('donasi-barang');
    Route::post('/donasi-barang/{barang}/verifikasi', [AdminController::class, 'verifikasiBarang'])->name('donasi-barang.verifikasi');

    // Kelola Feedback
    Route::get('/feedback', [AdminController::class, 'feedback'])->name('feedback');
    Route::delete('/feedback/{feedback}', [AdminController::class, 'hapusFeedback'])->name('feedback.hapus');

    // Kelola Users
    Route::get('/users', [AdminController::class, 'users'])->name('users');

    // Kelola Profil Admin
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [AdminController::class, 'updatePassword'])->name('profile.password');

    // Kelola Penyaluran (Dana + Barang, satu halaman)
    Route::get('/penyaluran', [PenyaluranController::class, 'index'])->name('penyaluran.index');

    // Kelola Penyaluran Dana
    Route::get('/penyaluran-dana', [PenyaluranDanaController::class, 'index'])->name('penyaluran-dana.index');
    Route::post('/penyaluran-dana', [PenyaluranDanaController::class, 'store'])->name('penyaluran-dana.store');
    Route::delete('/penyaluran-dana/{penyaluran_dana}', [PenyaluranDanaController::class, 'destroy'])->name('penyaluran-dana.destroy');

    // Kelola Penyaluran Barang
    Route::get('/penyaluran-barang', [PenyaluranBarangController::class, 'index'])->name('penyaluran-barang.index');
    Route::post('/penyaluran-barang', [PenyaluranBarangController::class, 'store'])->name('penyaluran-barang.store');
    Route::delete('/penyaluran-barang/{penyaluran_barang}', [PenyaluranBarangController::class, 'destroy'])->name('penyaluran-barang.destroy');

    // Kelola Transparansi
    Route::get('/transparansi', [TransparansiController::class, 'admin'])->name('transparansi.index');
    Route::post('/transparansi/dana/{donasi}/toggle', [TransparansiController::class, 'toggleDana'])->name('transparansi.toggle-dana');
    Route::post('/transparansi/barang/{barang}/toggle', [TransparansiController::class, 'toggleBarang'])->name('transparansi.toggle-barang');

    // Kelola Program Donasi
    Route::get('/program-donasi', [ProgramDonasiController::class, 'index'])->name('program-donasi.index');
    Route::get('/program-donasi/create', [ProgramDonasiController::class, 'create'])->name('program-donasi.create');
    Route::post('/program-donasi', [ProgramDonasiController::class, 'store'])->name('program-donasi.store');
    Route::get('/program-donasi/{program_donasi}/edit', [ProgramDonasiController::class, 'edit'])->name('program-donasi.edit');
    Route::put('/program-donasi/{program_donasi}', [ProgramDonasiController::class, 'update'])->name('program-donasi.update');
    Route::delete('/program-donasi/{program_donasi}', [ProgramDonasiController::class, 'destroy'])->name('program-donasi.destroy');


});