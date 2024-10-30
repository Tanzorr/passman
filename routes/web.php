<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaultController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::middleware(RoleMiddleware::class.':admin')->group(function () {
            Route::apiResource('users', UserController::class);
            Route::apiResource('vaults', VaultController::class);
            Route::apiResource('passwords', PasswordController::class);
            Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        });
    });

    // Public routes
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('/csrf-token', function () {
        return response()->json(['csrfToken' => csrf_token()]);
    });
});

// Home route
Route::get('/', function () {
    return view('welcome');
});
