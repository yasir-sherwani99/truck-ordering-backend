<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('booking', [App\Http\Controllers\BookingController::class, 'store']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('logout', [App\Http\Controllers\AuthController::class, 'logout']);
});
