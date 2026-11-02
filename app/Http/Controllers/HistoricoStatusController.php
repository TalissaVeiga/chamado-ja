<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use Illuminate\Http\JsonResponse;

class HistoricoStatusController extends Controller
{
    public function index(int $id): JsonResponse
    {
        $chamado = Chamado::find($id);

        if (!$chamado) {
            return response()->json([
                'mensagem' => 'Chamado não encontrado.',
            ], 404);
        }

        $historico = $chamado->historicoStatus()
            ->with('usuario:id,nome')
            ->orderBy('alterado_em', 'asc')
            ->get()
            ->map(function ($registro) {
                return [
                    'id' => $registro->id,
                    'chamado_id' => $registro->chamado_id,
                    'usuario_id' => $registro->usuario_id,
                    'status_anterior' => $registro->status_anterior,
                    'status_novo' => $registro->status_novo,
                    'status' => $registro->status,
                    'alterado_em' => $registro->alterado_em,
                    'usuario' => $registro->usuario,
                ];
            });

        return response()->json($historico);
    }
}
