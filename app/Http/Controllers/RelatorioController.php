<?php

namespace App\Http\Controllers;

use App\Models\Chamado;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function resumoChamados(): JsonResponse
    {
        $total = Chamado::count();

        $quantidadesPorStatus = Chamado::query()
            ->select('status', DB::raw('COUNT(*) as quantidade'))
            ->groupBy('status')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->status => (int) $item->quantidade];
            });

        return response()->json([
            'total_chamados' => $total,
            'por_status' => [
                'Pendente de Atendimento' => $quantidadesPorStatus->get(
                    'Pendente de Atendimento',
                    0
                ),
                'Em Atendimento' => $quantidadesPorStatus->get(
                    'Em Atendimento',
                    0
                ),
                'Cancelado' => $quantidadesPorStatus->get(
                    'Cancelado',
                    0
                ),
                'Resolvido' => $quantidadesPorStatus->get(
                    'Resolvido',
                    0
                ),
            ],
        ]);
    }
}
