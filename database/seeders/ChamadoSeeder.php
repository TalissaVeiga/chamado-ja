<?php

namespace Database\Seeders;

use App\Models\Chamado;
use Illuminate\Database\Seeder;

class ChamadoSeeder extends Seeder
{
    public function run(): void
    {
        if (Chamado::exists()) {
            $this->command->info(
                'Já existem chamados no banco. Nenhum chamado novo foi criado.'
            );

            return;
        }

        Chamado::factory()->count(4)->create();
    }
}
