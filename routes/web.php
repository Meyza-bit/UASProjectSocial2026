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
    Route::get('/donasi/create', [DonasiController::class, 'create'])->name('donasi.create');
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
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
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
});

Route::prefix('admin')->name('admin.')->group(function () {
    
    // URL: localhost:8000/admin
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // URL Action untuk Form (Backend Target)
    Route::post('/program/store', [AdminDashboardController::class, 'storeProgram'])->name('program.store');
    Route::post('/laporan/store', [AdminDashboardController::class, 'storeLaporan'])->name('laporan.store');
});