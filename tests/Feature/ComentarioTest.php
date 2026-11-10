<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ComentarioTest extends TestCase
{
    use RefreshDatabase;

    public function test_pode_criar_um_comentario_em_um_chamado(): void
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
            'status' => 'Pendente de Atendimento',
            'criado_em' => now(),
            'atualizado_em' => now(),
        ]);

        $response = $this->postJson(
            '/api/chamados/' . $chamadoId . '/comentarios',
            [
                'usuario_id' => $usuarioId,
                'comentario' => 'Verifiquei o problema no computador.',
            ]
        );

        $response->assertCreated();

        $this->assertDatabaseHas('comentarios', [
            'chamado_id' => $chamadoId,
            'usuario_id' => $usuarioId,
            'comentario' => 'Verifiquei o problema no computador.',
        ]);
    }
}
