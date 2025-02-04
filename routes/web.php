<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CidadesController;
use App\Http\Controllers\MedicosController;
use Illuminate\Support\Facades\Route;

# Rotas API`s
Route::prefix('api')->group(function () {

    # Rotas Públicas

    ## Login
    Route::post('/login', [AuthController::class, 'login']);

    ## Cidades
    Route::get('/cidades', [CidadesController::class, 'index']);
    Route::get('/cidades/{cidade_id}/medicos', [CidadesController::class, 'getMedicosByCidades']);

    ## Medicos
    Route::get('/medicos', [MedicosController::class, 'index']);

    # Rotas Protegidas (Requer Token JWT)

    ## User
    Route::get('/user', [AuthController::class, 'me'])->middleware('auth:api');

    ## Cadastrar Medico
    Route::post('/medicos', [MedicosController::class, 'store'])->middleware('auth:api');
});
