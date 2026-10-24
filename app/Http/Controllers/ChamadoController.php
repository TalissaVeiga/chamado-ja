<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class ChamadoController extends Controller
{
    private function formatarChamado(Chamado $chamado): array
    {
        $chamado->load([
            'solicitante:id,nome,telefone',
            'categoria:id,nome',
        ]);

        return [
            'id' => $chamado->id,
            'solicitante_id' => $chamado->solicitante_id,
            'categoria_id' => $chamado->categoria_id,
            'titulo' => $chamado->titulo,
            'descricao' => $chamado->descricao,
            'prioridade' => $chamado->prioridade,
            'status' => $chamado->status,
            'created_at' => $chamado->created_at,
            'updated_at' => $chamado->updated_at,
            'solicitante' => $chamado->solicitante,
            'categoria' => $chamado->categoria,
        ];
    }

    public function index(): JsonResponse
    {
        $chamados = Chamado::with([
            'solicitante:id,nome,telefone',
            'categoria:id,nome',
        ])->get();

        return response()->json(
            $chamados->map(fn (Chamado $chamado) => $this->formatarChamado($chamado))
        );
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
            $this->formatarChamado($chamado),
            201
        );
    }

    public function show(int $id): JsonResponse
    {
        $chamado = Chamado::find($id);

        if (!$chamado) {
            return response()->json([
                'mensagem' => 'Chamado não encontrado.',
            ], 404);
        }

        return response()->json($this->formatarChamado($chamado));
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

        return response()->json($this->formatarChamado($chamado));
    }
}