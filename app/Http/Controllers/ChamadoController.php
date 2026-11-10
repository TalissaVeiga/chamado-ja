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
            'criado_em' => $chamado->criado_em,
            'atualizado_em' => $chamado->atualizado_em,
            'solicitante' => $chamado->solicitante,
            'categoria' => $chamado->categoria,
        ];
    }

  public function index(Request $request): JsonResponse
{
   $request->validate([
    'data_inicio' => [
        'sometimes',
        'required',
        'date',
    ],
    'data_fim' => [
        'sometimes',
        'required',
        'date',
        'after_or_equal:data_inicio',
    ],
    ]);
    $consulta = Chamado::query()->with([
        'solicitante:id,nome,telefone',
        'categoria:id,nome',
    ]);

    $consulta->when($request->status, function ($consulta, $status) {
        $consulta->where('status', $status);
    });

    $consulta->when($request->prioridade, function ($consulta, $prioridade) {
        $consulta->where('prioridade', $prioridade);
    });

    $consulta->when($request->categoria_id, function ($consulta, $categoriaId) {
        $consulta->where('categoria_id', $categoriaId);
    });

    $consulta->when($request->solicitante_id, function ($consulta, $solicitanteId) {
        $consulta->where('solicitante_id', $solicitanteId);
    });
    $consulta->when($request->data_inicio, function ($consulta, $dataInicio) {
    $consulta->whereDate('criado_em', '>=', $dataInicio);
    });
    $consulta->when($request->data_fim, function ($consulta, $dataFim) {
    $consulta->whereDate('criado_em', '<=', $dataFim);
    });

    $ordenacoesPermitidas = ['criado_em', 'prioridade', 'status'];

    $ordenacao = in_array($request->ordenar_por, $ordenacoesPermitidas, true)
        ? $request->ordenar_por
        : 'criado_em';

    $chamados = $consulta
        ->orderByDesc($ordenacao)
        ->paginate(15);

    $chamados->getCollection()->transform(
        fn (Chamado $chamado) => $this->formatarChamado($chamado)
    );

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
            $this->formatarChamado($chamado),
            201
        );
    }

    public function show(int $id): JsonResponse
    {
        $chamado = Chamado::find($id);

        if (!$chamado) {
            return response()->json([
                'message' => 'Chamado não encontrado.',
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