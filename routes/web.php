<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\TransparansiController;

// 1. Rute Utama (Halaman Beranda / Home)
Route::get('/', function () {
    $programs = DB::table('programs')->get();
    return view('home', compact('programs'));
})->name('home');

// 2. Rute untuk Halaman Katalog Program Donasi
Route::get('/program', function () {
    $programs = DB::table('programs')->get();
    return view('program', compact('programs'));
})->name('program.index');

// 3. Rute untuk Halaman Transparansi Dana Donasi
Route::get('/transparansi', [TransparansiController::class, 'index'])->name('transparansi.index');