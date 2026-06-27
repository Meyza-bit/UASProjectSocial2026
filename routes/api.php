<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\TransparansiController;

// ============================================================
// ROUTE PUBLIK (tidak perlu login)
// ============================================================
Route::get('/transparansi', [TransparansiController::class, 'index']);
Route::get('/transparansi/{program_id}', [TransparansiController::class, 'show']);

Route::get('/feedbacks', [FeedbackController::class, 'index']);
Route::get('/feedbacks/{id}', [FeedbackController::class, 'show']);

// ============================================================
// ROUTE PROTECTED (perlu login - Sanctum)
// ============================================================
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/feedbacks', [FeedbackController::class, 'store']);
    Route::put('/feedbacks/{id}', [FeedbackController::class, 'update']);
    Route::delete('/feedbacks/{id}', [FeedbackController::class, 'destroy']);
});