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
            'tipo' => ['A', 'C'][array_rand(['A', 'C'])],  // Asigna 'A' o 'C' aleatoriamente
            'cuit' => $this->generateCuit(),  // Genera un CUIT en el formato XX-XXXXXXXX-X
            'user_id' => fake()->unique()->numberBetween(29, 34)
        ];
    }


    /**
     * Generate a CUIT in the format XX-XXXXXXXX-X.
     *
     * @return string
     */
    private function generateCuit()
    {
        $part1 = rand(20, 99); // Dos dígitos
        $part2 = rand(10000000, 99999999); // Ocho dígitos
        $part3 = rand(0, 9); // Un dígito

        return sprintf('%02d-%08d-%d', $part1, $part2, $part3);
    }
}
