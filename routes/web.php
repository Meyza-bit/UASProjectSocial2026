<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/feedback', [FeedbackController::class, 'index'])
    ->name('feedback.index');

Route::post('/feedback', [FeedbackController::class, 'store'])
    ->name('feedback.store');
