<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Hardware', 'Sistema Operacional'] as $nome) {
            Categoria::firstOrCreate(['nome' => $nome]);
        }
    }
}
