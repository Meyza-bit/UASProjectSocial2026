<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// Memastikan rute mengarah ke halaman utama (simbol /)
Route::get('/', function () {
    // Mengambil data dummy dari database
    $programs = DB::table('programs')->get();
    
    // Melempar data ke file home.blade.php
    return view('home', compact('programs'));
});