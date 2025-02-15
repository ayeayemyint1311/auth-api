<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Public Routes
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes (Require Authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
