<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;

// --- ENDPOINTS PÚBLICOS (AUTENTICACIÓN) ---
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

// --- ENDPOINTS PROTEGIDOS (REQUIEREN TOKEN JWT) ---
Route::middleware('auth:api')->group(function () {
    // Autenticación adicional
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/me', [AuthController::class, 'me']);

    // Endpoints del Catálogo de Libros (/api/books)
    Route::apiResource('books', BookController::class);
});