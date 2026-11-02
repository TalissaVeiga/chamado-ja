<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\StatusChamadoController;
use App\Http\Controllers\HistoricoStatusController;
use App\Http\Controllers\RelatorioController;

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
// Comentários dos chamados
Route::get('/chamados/{id}/comentarios', [ComentarioController::class, 'index']);
Route::post('/chamados/{id}/comentarios', [ComentarioController::class, 'store']);

// Alteração de status
Route::patch('/chamados/{id}/status', [StatusChamadoController::class, 'atualizar']);

// Histórico de status
Route::get('/chamados/{id}/historico', [HistoricoStatusController::class, 'index']);

// Relatório quantitativo
Route::get('/relatorios/resumo-chamados', [RelatorioController::class, 'resumoChamados']);