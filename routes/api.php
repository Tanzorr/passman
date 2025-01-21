<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EntityMediaController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\SharedAccessController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaultController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('users', UserController::class)->only(['destroy', 'store', 'update']);
    });
    Route::apiResource('users', UserController::class)->only(['index', 'show']);
    Route::apiResource('vaults', VaultController::class);
    Route::apiResource('passwords', PasswordController::class);
    Route::apiResource('/shared-accesses', SharedAccessController::class);
    Route::get(
        '/users/not-access/{entity}/{entityId}',
        [UserController::class, 'getNotAccessedUsers']
    );
    Route::apiResource('/medias', MediaController::class);
    Route::prefix('entities/media')->group(function () {
        Route::post('attach', [EntityMediaController::class, 'attach']);
        Route::post('detach', [EntityMediaController::class, 'detach']);
    });
    Route::apiResource('pages', PageController::class);
});

Route::get('/csrf-token', function () {
    return response()->json(['csrfToken' => csrf_token()]);
});

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout']);
