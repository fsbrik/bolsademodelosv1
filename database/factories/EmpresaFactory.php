<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Empresa>
 */
class EmpresaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom_com' => fake()->company(),
            'domicilio' => fake()->address(),
            'rubro' => fake()->catchPhrase(),
            'user_id' => fake()->unique()->numberBetween(1, 3)
        ];
    }
}
