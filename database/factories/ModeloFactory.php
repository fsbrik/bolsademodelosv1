<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Modelo>
 */
class ModeloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $counter = 75;
    

    public function definition(): array
    {
        $localidades = include(public_path('storage/localidades/localidades.php'));
             
        return [
            'id' => $this->counter,
            'mod_id' => 'mod' . $this->counter++,//fake()->unique()->numberBetween(4, 20), // Generar un ID único para cada modelo
            //'nom_ape' => fake()->name,
            'fec_nac' => fake()->date(),
            'sexo' => fake()->randomElement(['F', 'M']),
            'estatura' => fake()->randomFloat(2, 1.65, 1.90), // Estatura entre 1.5 y 2.0 metros
            'medidas' => fake()->randomNumber(2) . '-' . fake()->randomNumber(2) . '-' . fake()->randomNumber(2),
            'calzado' => fake()->randomElement(['36', '37', '38', '39', '40']),
            'zon_res' => fake()->randomElement($localidades),
            'dis_via' => fake()->boolean,
            'tit_mod' => fake()->boolean,
            'ingles' => fake()->randomElement(['basico', 'intermedio', 'avanzado']),
            'dis_tra' => fake()->randomElement(['modelo', 'promotora', 'ambas']),
            'descripcion' => fake()->paragraph,
            'tar_med' => fake()->randomFloat(2, 50, 500),
            'tar_com' => fake()->randomFloat(2, 100, 1000),
            //'dir_fot' => fake()->userName,
            'estado' => fake()->boolean,
            'habilita' => fake()->boolean,
            'user_id' => 35,
            //'user_id' => fake()->unique()->numberBetween(37, 75)
        ];
    }
}
