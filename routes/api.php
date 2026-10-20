
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::get('/saude', function () {
    return response()->json([
        'status' => 'ok',
        'mensagem' => 'API ChamadoJá funcionando!'
    ]);
});

Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::post('/usuarios', [UsuarioController::class, 'store']);
