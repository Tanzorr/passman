<?php

use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaultController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('vaults', VaultController::class);
    Route::apiResource('passwords', PasswordController::class);

    Route::get('/csrf-token', function () {
        return response()->json(['csrfToken' => csrf_token()]);
    });
});

Route::get('/', function () {
    return view('welcome');
});
