<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class StatusChamadoTest extends TestCase
{
    use RefreshDatabase;

    private function criarChamadoComStatus(string $status): array
    {
        $usuarioId = DB::table('usuarios')->insertGetId([
            'nome' => 'Maria Silva',
            'telefone' => '51999990001',
        ]);

        $categoriaId = DB::table('categorias')->insertGetId([
            'nome' => 'Hardware',
        ]);

        $chamadoId = DB::table('chamados')->insertGetId([
            'solicitante_id' => $usuarioId,
            'categoria_id' => $categoriaId,
            'titulo' => 'Computador não liga',
            'descricao' => 'O computador não está ligando.',
            'prioridade' => 'Alta',
            'status' => $status,
            'criado_em' => now(),
            'atualizado_em' => now(),
        ]);

        return [
            'usuario_id' => $usuarioId,
            'chamado_id' => $chamadoId,
        ];
    }

    public function test_pode_alterar_status_de_chamado(): void
    {
        $dados = $this->criarChamadoComStatus('Pendente de Atendimento');

        $response = $this->patchJson(
            '/api/chamados/' . $dados['chamado_id'] . '/status',
            [
                'usuario_id' => $dados['usuario_id'],
                'status' => 'Em Atendimento',
            ]
        );

        $response->assertOk();

        $this->assertDatabaseHas('chamados', [
            'id' => $dados['chamado_id'],
            'status' => 'Em Atendimento',
        ]);

        $this->assertDatabaseHas('historico_status', [
            'chamado_id' => $dados['chamado_id'],
            'usuario_id' => $dados['usuario_id'],
            'status_anterior' => 'Pendente de Atendimento',
            'status_novo' => 'Em Atendimento',
        ]);
    }

    public function test_nao_pode_alterar_chamado_cancelado_para_resolvido(): void
    {
        $dados = $this->criarChamadoComStatus('Cancelado');

        $response = $this->patchJson(
            '/api/chamados/' . $dados['chamado_id'] . '/status',
            [
                'usuario_id' => $dados['usuario_id'],
                'status' => 'Resolvido',
            ]
        );

        $response->assertUnprocessable();

        $this->assertDatabaseHas('chamados', [
            'id' => $dados['chamado_id'],
            'status' => 'Cancelado',
        ]);

        $this->assertDatabaseMissing('historico_status', [
            'chamado_id' => $dados['chamado_id'],
        ]);
    }
}
