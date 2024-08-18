<?php

use App\Http\Controllers\SaldoController;
use App\Http\Controllers\TransferenciaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/usuarios',UsuarioController::class);
Route::apiResource('/transferencias',TransferenciaController::class);
Route::apiResource('/saldos',SaldoController::class);

