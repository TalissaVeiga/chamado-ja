<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChamadoTest extends TestCase
{
    use RefreshDatabase;

    public function test_nao_pode_abrir_chamado_com_usuario_e_categoria_inexistentes(): void
    {
        $response = $this->postJson('/api/chamados', [
            'solicitante_id' => 999,
            'categoria_id' => 999,
            'titulo' => 'Computador não liga',
            'descricao' => 'O computador não está ligando.',
            'prioridade' => 'Alta',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors([
                'solicitante_id',
                'categoria_id',
            ]);
    }

    public function test_nao_pode_consultar_chamado_inexistente(): void
    {
        $response = $this->getJson('/api/chamados/999');

        $response->assertNotFound()
            ->assertJson([
                'message' => 'Chamado não encontrado.',
            ]);
    }

public function test_pode_abrir_um_chamado(): void
{
    $usuarioId = \Illuminate\Support\Facades\DB::table('usuarios')->insertGetId([
        'nome' => 'Maria Silva',
        'telefone' => '51999990001',
    ]);

    $categoriaId = \Illuminate\Support\Facades\DB::table('categorias')->insertGetId([
        'nome' => 'Hardware',
    ]);

    $response = $this->postJson('/api/chamados', [
        'solicitante_id' => $usuarioId,
        'categoria_id' => $categoriaId,
        'titulo' => 'Computador não liga',
        'descricao' => 'O computador não está ligando.',
        'prioridade' => 'Alta',
    ]);

    $response->assertCreated();

    $this->assertDatabaseHas('chamados', [
        'solicitante_id' => $usuarioId,
        'categoria_id' => $categoriaId,
        'titulo' => 'Computador não liga',
        'status' => 'Pendente de Atendimento',
    ]);
}

}
