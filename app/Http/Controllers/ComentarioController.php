<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use App\Models\Comentario;
use App\Models\Usuario;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function index(int $id): JsonResponse
    {
        $chamado = Chamado::find($id);

        if (!$chamado) {
            return response()->json([
                'mensagem' => 'Chamado não encontrado.',
            ], 404);
        }

        $comentarios = $chamado->comentarios()
            ->with('usuario:id,nome')
            ->get()
            ->map(function (Comentario $comentario) {
                return [
                    'id' => $comentario->id,
                    'chamado_id' => $comentario->chamado_id,
                    'usuario_id' => $comentario->usuario_id,
                    'comentario' => $comentario->comentario,
                    'criado_em' => $comentario->criado_em,
                    'usuario' => $comentario->usuario,
                ];
            });

        return response()->json($comentarios);
    }

    public function store(Request $request, int $id): JsonResponse
    {
        $chamado = Chamado::find($id);

        if (!$chamado) {
            return response()->json([
                'mensagem' => 'Chamado não encontrado.',
            ], 404);
        }

        $dados = $request->validate([
            'usuario_id' => [
                'required',
                'integer',
                'exists:usuarios,id',
            ],
            'comentario' => [
                'required',
                'string',
                'min:1',
            ],
        ]);

        $comentario = Comentario::create([
            'chamado_id' => $chamado->id,
            'usuario_id' => $dados['usuario_id'],
            'comentario' => $dados['comentario'],
        ]);
        $comentario->refresh();
        $comentario->load('usuario:id,nome');

        return response()->json([
            'id' => $comentario->id,
            'chamado_id' => $comentario->chamado_id,
            'usuario_id' => $comentario->usuario_id,
            'comentario' => $comentario->comentario,
            'criado_em' => $comentario->criado_em,
            'usuario' => $comentario->usuario,
        ], 201);
    }
}
