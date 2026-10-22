<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoriaController extends Controller
{
    public function index(): JsonResponse
    {
        $categorias = Categoria::all();

        return response()->json($categorias);
    }

    public function store(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:20'],
        ]);

        $categoria = Categoria::create($dados);

        return response()->json($categoria, 201);
    }
}
