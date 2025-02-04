<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

# Rotas API`s
Route::prefix('api')->group(function () {

    # Rotas Públicas
    Route::post('/login', [AuthController::class, 'login']);

    # Rotas Protegidas (Requer Token JWT)
    Route::middleware('auth:api')->group(function () {

        # User
        Route::get('/user', [AuthController::class, 'me']);

    });
});
