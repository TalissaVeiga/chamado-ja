<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ChamadoController;

Route::get('/saude', function () {
    return response()->json([
        'status' => 'ok',
        'mensagem' => 'API ChamadoJá funcionando!'
    ]);
});

Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::post('/usuarios', [UsuarioController::class, 'store']);
Route::get('/categorias', [CategoriaController::class, 'index']);
Route::post('/categorias', [CategoriaController::class, 'store']);
Route::get('/chamados', [ChamadoController::class, 'index']);
Route::post('/chamados', [ChamadoController::class, 'store']);
Route::get('/chamados/{id}', [ChamadoController::class, 'show']);
Route::patch('/chamados/{id}', [ChamadoController::class, 'update']);