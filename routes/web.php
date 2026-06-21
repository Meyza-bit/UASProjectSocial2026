<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// 1. Rute Utama (Halaman Beranda / Home)
Route::get('/', function () {
    $programs = DB::table('programs')->get();
    return view('home', compact('programs'));
})->name('home');

// 2. Rute untuk Halaman Katalog Program Donasi (Versi Flat Tanpa Folder)
Route::get('/program', function () {
    $programs = DB::table('programs')->get();
    
    // Langsung mengarah ke file program.blade.php
    return view('program', compact('programs'));
})->name('program.index');