<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        if (Usuario::exists()) {
            $this->command->info('Já existem usuários cadastrados.');
            return;
        }

        Usuario::factory()->count(3)->create();
    }
}