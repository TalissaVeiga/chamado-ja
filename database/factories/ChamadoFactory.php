<?php

namespace Database\Factories;

use App\Models\Chamado;
use App\Models\Usuario;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Chamado>
 */
class ChamadoFactory extends Factory
{
    protected $model = Chamado::class;

    public function definition(): array
    {
        return [
            'solicitante_id' => Usuario::query()->inRandomOrder()->value('id'),
            'categoria_id' => Categoria::query()->inRandomOrder()->value('id'),
            'titulo' => fake()->sentence(4),
            'descricao' => fake()->paragraph(),
            'prioridade' => fake()->randomElement(['Baixa', 'Média', 'Alta']),
            'status' => fake()->randomElement([
                'Pendente de Atendimento',
                'Em Atendimento',
                'Cancelado',
                'Resolvido',
            ]),
        ];
    }
}
