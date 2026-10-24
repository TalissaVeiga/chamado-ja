<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UsuarioController extends Controller
{
    public function index(): JsonResponse
    {
        $usuarios = Usuario::query()
            ->select(['id', 'nome', 'telefone'])
            ->get();

        return response()->json($usuarios);
    }

    public function store(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:100'],
            'telefone' => ['nullable', 'string', 'max:20'],
        ]);

        $usuario = Usuario::create($dados);

        return response()->json([
            'id' => $usuario->id,
            'nome' => $usuario->nome,
            'telefone' => $usuario->telefone,
        ], 201);
    }
}