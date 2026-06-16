<?php

use Illuminate\Support\Facades\Route;
// 1. PASTIKAN UNTUK MENGIMPORT CONTROLLER KAMU DI SINI
// use fully-qualified controller references in routes to avoid static analysis
// errors when the controller class cannot be resolved here.

// Route untuk halaman utama (berdiri sendiri)
Route::get('/', function () {
    return view('welcome');
});

// Route untuk feedback (berdiri sendiri, di luar fungsi route lain)
Route::get('/feedback', 'App\\Http\\Controllers\\FeedbackController@index')->name('feedback.index');
Route::post('/feedback', 'App\\Http\\Controllers\\FeedbackController@store')->name('feedback.store')->middleware('auth');
Route::get('/feedback/terbaik', 'App\\Http\\Controllers\\FeedbackController@terbaik')->name('feedback.terbaik');