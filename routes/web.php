<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CidadesController;
use App\Http\Controllers\MedicosController;
use App\Http\Controllers\PacientesController;
use Illuminate\Support\Facades\Route;

# Rotas API`s
Route::prefix('api')->group(function () {

    # Rotas Públicas

    ## Login
    Route::post('/login', [AuthController::class, 'login']);

    ## Cidades
    Route::get('/cidades', [CidadesController::class, 'index']);

    ## Buscar Médicos por Cidades
    Route::get('/cidades/{cidade_id}/medicos', [CidadesController::class, 'getMedicosByCidades']);

    ## Medicos
    Route::get('/medicos', [MedicosController::class, 'index']);

    # Rotas Protegidas (Requer Token JWT)

    ## User
    Route::get('/user', [AuthController::class, 'me'])->middleware('auth:api');
    
    ## Cadastrar Medico
    Route::post('/medicos', [MedicosController::class, 'store'])->middleware('auth:api');

    ## Nova consulta
    Route::post('/medicos/consulta', [MedicosController::class, 'storeConsulta'])->middleware('auth:api');

    ## Buscar pacientes por Médicos
    Route::get('/medicos/{medico_id}/pacientes', [MedicosController::class, 'getPacientesByMedico'])->middleware('auth:api');

    ## Pacientes
    Route::post('/pacientes', [PacientesController::class, 'store'])->middleware('auth:api');
    Route::put('/pacientes/{paciente_id}', [PacientesController::class, 'update'])->middleware('auth:api');
});
