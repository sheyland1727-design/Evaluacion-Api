<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CargoController;
use App\Http\Controllers\Api\EmpleadoController;
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // CRUD Cargos
    Route::get('/cargos', [CargoController::class, 'index']);
    Route::get('/cargos/{id}', [CargoController::class, 'show']);
    Route::post('/cargos', [CargoController::class, 'store']);
    Route::put('/cargos/{id}', [CargoController::class, 'update']);
    Route::delete('/cargos/{id}', [CargoController::class, 'destroy']);

        // CRUD Empleados
    Route::get('/empleados', [EmpleadoController::class, 'index']);
    Route::get('/empleados/{id}', [EmpleadoController::class, 'show']);
    Route::post('/empleados', [EmpleadoController::class, 'store']);
    Route::put('/empleados/{id}', [EmpleadoController::class, 'update']);
    Route::delete('/empleados/{id}', [EmpleadoController::class, 'destroy']);

});