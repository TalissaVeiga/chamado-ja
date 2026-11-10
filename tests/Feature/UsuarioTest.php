<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsuarioTest extends TestCase
{
    use RefreshDatabase;

    public function test_pode_cadastrar_um_usuario(): void
    {
        $response = $this->postJson('/api/usuarios', [
            'nome' => 'Maria Silva',
            'telefone' => '51999990001',
        ]);

        $response->assertCreated();

        $this->assertDatabaseHas('usuarios', [
            'nome' => 'Maria Silva',
            'telefone' => '51999990001',
        ]);
    }

    public function test_nao_pode_cadastrar_usuario_sem_nome(): void
    {
        $response = $this->postJson('/api/usuarios', [
            'telefone' => '51999990001',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['nome']);
    }
}
