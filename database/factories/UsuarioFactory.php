<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'nome' => $this->faker->name,
            'email' => $this->faker->email(),
            'cpf' => $this->faker->randomNumber(11),
            'senha' => $this->faker->randomNumber(11),
            'tipo' => 1,
        ];
    }
}
