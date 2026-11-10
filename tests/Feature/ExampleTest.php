<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_a_api_retorna_status_de_saude(): void
    {
        $response = $this->getJson('/api/saude');

        $response->assertOk();
    }
}
