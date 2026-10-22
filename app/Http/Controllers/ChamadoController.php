<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class ChamadoController extends Controller
{
    public function index(): JsonResponse
    {
        $chamados = Chamado::with(['solicitante', 'categoria'])->get();

        return response()->json($chamados);
    }

    public function store(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'solicitante_id' => [
                'required',
                'integer',
                'exists:usuarios,id',
            ],
            'categoria_id' => [
                'required',
                'integer',
                'exists:categorias,id',
            ],
            'titulo' => [
                'required',
                'string',
                'max:120',
            ],
            'descricao' => [
                'required',
                'string',
                'min:10',
            ],
            'prioridade' => [
                'required',
                'string',
                Rule::in(['Baixa', 'Média', 'Alta']),
            ],
        ]);

        $chamado = Chamado::create([
            ...$dados,
            'status' => 'Pendente de Atendimento',
        ]);

        return response()->json(
            $chamado->load(['solicitante', 'categoria']),
            201
        );
    }

    public function show(int $id): JsonResponse
    {
        $chamado = Chamado::with(['solicitante', 'categoria'])
            ->find($id);

        if (!$chamado) {
            return response()->json([
                'mensagem' => 'Chamado não encontrado.',
            ], 404);
        }

        return response()->json($chamado);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $chamado = Chamado::find($id);

        if (!$chamado) {
            return response()->json([
                'mensagem' => 'Chamado não encontrado.',
            ], 404);
        }

        $dados = $request->validate([
            'solicitante_id' => [
                'sometimes',
                'required',
                'integer',
                'exists:usuarios,id',
            ],
            'categoria_id' => [
                'sometimes',
                'required',
                'integer',
                'exists:categorias,id',
            ],
            'titulo' => [
                'sometimes',
                'required',
                'string',
                'max:120',
            ],
            'descricao' => [
                'sometimes',
                'required',
                'string',
                'min:10',
            ],
            'prioridade' => [
                'sometimes',
                'required',
                'string',
                Rule::in(['Baixa', 'Média', 'Alta']),
            ],
        ]);

        $chamado->update($dados);

        return response()->json(
            $chamado->load(['solicitante', 'categoria'])
        );
    }
}
