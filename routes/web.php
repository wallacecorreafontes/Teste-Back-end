<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CidadesController;
use Illuminate\Support\Facades\Route;

# Rotas API`s
Route::prefix('api')->group(function () {

    # Rotas Públicas

    ## Login
    Route::post('/login', [AuthController::class, 'login']);

    ## Cidades
    Route::get('/cidades', [CidadesController::class, 'index']);

    # Rotas Protegidas (Requer Token JWT)

    ## User
    Route::get('/user', [AuthController::class, 'me'])->middleware('auth:api');
});
