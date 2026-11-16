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
        $exemplos = [
            [
                'titulo' => 'Computador não liga',
                'descricao' => 'O computador não liga ao pressionar o botão de energia. Já foi verificada a conexão do cabo.',
            ],
            [
                'titulo' => 'Teclado não funciona',
                'descricao' => 'O teclado parou de responder durante o uso. Já foi testada outra entrada USB.',
            ],
            [
                'titulo' => 'Problema ao iniciar o sistema',
                'descricao' => 'O computador apresenta uma mensagem de erro durante a inicialização do sistema operacional.',
            ],
            [
                'titulo' => 'Computador muito lento',
                'descricao' => 'O computador está apresentando lentidão ao abrir programas e executar tarefas.',
            ],
        ];

        $exemplo = fake()->randomElement($exemplos);

        return [
            'solicitante_id' => Usuario::query()->inRandomOrder()->value('id'),
            'categoria_id' => Categoria::query()->inRandomOrder()->value('id'),
            'titulo' => $exemplo['titulo'],
            'descricao' => $exemplo['descricao'],
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
