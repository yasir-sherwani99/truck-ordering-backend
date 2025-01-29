<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('booking', [App\Http\Controllers\BookingController::class, 'store']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::get('bookings', [App\Http\Controllers\BookingController::class, 'index']);
});

Route::prefix('admin')->group(function() {
    Route::post('login', [App\Http\Controllers\Admin\AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function() {
        Route::get('logout', [App\Http\Controllers\Admin\AuthController::class, 'logout']);
        Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
        Route::get('bookings', [App\Http\Controllers\Admin\BookingController::class, 'index']);
        Route::get('booking/{booking}/details', [App\Http\Controllers\Admin\BookingController::class, 'show']);
        Route::put('booking/{booking}/status', [App\Http\Controllers\Admin\BookingController::class, 'update']);
    });
});
