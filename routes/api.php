<?php

use Illuminate\Support\Facades\Route;

Route::get('/saude', function () {
    return response()->json([
        'status' => 'ok',
        'mensagem' => 'API ChamadoJá funcionando!'
    ]);
});
