<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use App\Models\HistoricoStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StatusChamadoController extends Controller
{
    public function atualizar(Request $request, int $id): JsonResponse
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
            'status' => [
                'required',
                'string',
                Rule::in([
                    'Pendente de Atendimento',
                    'Em Atendimento',
                    'Cancelado',
                    'Resolvido',
                ]),
            ],
        ]);

        $statusAnterior = $chamado->status;
        $statusNovo = $dados['status'];

        if ($statusAnterior === $statusNovo) {
            return response()->json([
                'mensagem' => 'O chamado já está nesse status.',
            ], 422);
        }

        $transicoesPermitidas = [
            'Pendente de Atendimento' => [
                'Em Atendimento',
                'Cancelado',
            ],
            'Em Atendimento' => [
                'Pendente de Atendimento',
                'Cancelado',
                'Resolvido',
            ],
            'Resolvido' => [
                'Em Atendimento',
            ],
            'Cancelado' => [],
        ];

        if (!in_array(
            $statusNovo,
            $transicoesPermitidas[$statusAnterior] ?? [],
            true
        )) {
            return response()->json([
                'mensagem' => 'Essa mudança de status não é permitida.',
            ], 422);
        }

        $historico = DB::transaction(function () use (
            $chamado,
            $dados,
            $statusAnterior,
            $statusNovo
        ) {
            $chamado->status = $statusNovo;
            $chamado->save();

            return HistoricoStatus::create([
                'chamado_id' => $chamado->id,
                'usuario_id' => $dados['usuario_id'],
                'status' => $statusNovo,
                'status_anterior' => $statusAnterior,
                'status_novo' => $statusNovo,
                'alterado_em' => now(),
            ]);
        });

        return response()->json([
            'mensagem' => 'Status do chamado atualizado com sucesso.',
            'chamado_id' => $chamado->id,
            'status_anterior' => $statusAnterior,
            'status_novo' => $statusNovo,
            'historico_id' => $historico->id,
            'alterado_em' => $historico->alterado_em,
        ]);
    }
}
