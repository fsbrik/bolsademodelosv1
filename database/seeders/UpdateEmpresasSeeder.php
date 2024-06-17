<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;

class UpdateEmpresasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $empresas = Empresa::all();

        foreach ($empresas as $empresa) {
            $empresa->update([
                'tipo' => ['A', 'C'][array_rand(['A', 'C'])],  // Asigna 'A' o 'C' aleatoriamente
                'cuit' => $this->generateCuit(),  // Genera un CUIT en el formato XX-XXXXXXXX-X
            ]);
        }
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
