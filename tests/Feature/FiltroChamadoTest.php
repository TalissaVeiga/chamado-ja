<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class FiltroChamadoTest extends TestCase
{
    use RefreshDatabase;

    private function criarChamado(string $titulo, string $prioridade): void
    {
        $usuarioId = DB::table('usuarios')->insertGetId([
            'nome' => 'Maria Silva',
            'telefone' => '51999990001',
        ]);

        $categoria = DB::table('categorias')
    ->where('nome', 'Hardware')
    ->first();

if (!$categoria) {
    $categoriaId = DB::table('categorias')->insertGetId([
        'nome' => 'Hardware',
    ]);
} else {
    $categoriaId = $categoria->id;
}

        DB::table('chamados')->insert([
            'solicitante_id' => $usuarioId,
            'categoria_id' => $categoriaId,
            'titulo' => $titulo,
            'descricao' => 'Descrição do problema.',
            'prioridade' => $prioridade,
            'status' => 'Pendente de Atendimento',
            'criado_em' => now(),
            'atualizado_em' => now(),
        ]);
    }

    public function test_pode_filtrar_chamados_por_prioridade(): void
    {
        $this->criarChamado('Computador lento', 'Baixa');
        $this->criarChamado('Computador não liga', 'Alta');

        $response = $this->getJson('/api/chamados?prioridade=Alta');

        $response->assertOk()
            ->assertJsonPath('data.0.titulo', 'Computador não liga')
            ->assertJsonCount(1, 'data');
    }

    public function test_lista_de_chamados_possui_paginacao(): void
    {
        for ($i = 1; $i <= 16; $i++) {
            $this->criarChamado('Chamado ' . $i, 'Média');
        }

        $response = $this->getJson('/api/chamados');

        $response->assertOk()
            ->assertJsonCount(15, 'data')
            ->assertJsonPath('current_page', 1)
            ->assertJsonPath('last_page', 2);
    }
}
