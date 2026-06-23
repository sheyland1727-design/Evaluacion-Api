<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CargoController;
use App\Http\Controllers\Api\EmpleadoController;
use App\Http\Controllers\Api\FuncionCargoController;
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // CRUD Cargos
    Route::get('/cargos', [CargoController::class, 'index']);
    Route::get('/cargos/{id}', [CargoController::class, 'show']);
    Route::post('/cargos', [CargoController::class, 'store']);
    Route::put('/cargos/{id}', [CargoController::class, 'update']);
    Route::delete('/cargos/{id}', [CargoController::class, 'destroy']);

    Route::get('/cargos/{id}/funciones', [CargoController::class, 'funciones']);

        // CRUD Empleados
    Route::get('/empleados', [EmpleadoController::class, 'index']);
    Route::get('/empleados/{id}', [EmpleadoController::class, 'show']);
    Route::post('/empleados', [EmpleadoController::class, 'store']);
    Route::put('/empleados/{id}', [EmpleadoController::class, 'update']);
    Route::delete('/empleados/{id}', [EmpleadoController::class, 'destroy']);

    Route::get('/empleados/{id}/detalle', [EmpleadoController::class, 'detalle']); 

    
    // CRUD Funciones
Route::get('/funciones', [FuncionCargoController::class, 'index']);
Route::get('/funciones/{id}', [FuncionCargoController::class, 'show']);
Route::post('/funciones', [FuncionCargoController::class, 'store']);
Route::put('/funciones/{id}', [FuncionCargoController::class, 'update']);
Route::delete('/funciones/{id}', [FuncionCargoController::class, 'destroy']);


});