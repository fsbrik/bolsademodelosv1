<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modelo;

class ModelosColorCabelloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = ['rubio', 'castaño', 'pelirrojo', 'morocho', 'otro'];

        Modelo::all()->each(function ($modelo) use ($colors) {
            $modelo->update([
                'col_cab' => $colors[array_rand($colors)]
            ]);
        });
    }
}
