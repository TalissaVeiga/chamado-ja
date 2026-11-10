<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriaTest extends TestCase
{
    use RefreshDatabase;

    public function test_pode_cadastrar_uma_categoria(): void
    {
        $response = $this->postJson('/api/categorias', [
            'nome' => 'Hardware',
        ]);

        $response->assertCreated();

        $this->assertDatabaseHas('categorias', [
            'nome' => 'Hardware',
        ]);
    }
}
