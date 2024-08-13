<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioContratacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Servicio::create([
            'nom_ser' => 'Plan single',
            'cat_ser' => 'empresa',
            'sub_cat' => 'contrataciones',
            'des_ser' => 'Plan único. Pagás una sola vez por cada modelo que contrates. Ideal para contrataciones eventuales.',
            'precio' => 50000,
            'hab_ser' => 1,
        ]);

        Servicio::create([
            'nom_ser' => 'Plan mensual',
            'cat_ser' => 'empresa',
            'sub_cat' => 'contrataciones',
            'des_ser' => 'Plan mensual. Pagás por 30 días. Podés contratar hasta 5 modelos durante 30 días. Ahorrás un 30%. Ideal para empresas pequeñas y por cambio de temporada.',
            'precio' => 175000,
            'hab_ser' => 1,
        ]);

        Servicio::create([
            'nom_ser' => 'Plan anual',
            'cat_ser' => 'empresa',
            'sub_cat' => 'contrataciones',
            'des_ser' => 'Plan anual. Pagás por 365 días. Podés contratar modelos ilimitadas durante 365 días. Acceso full sin restricciones. Ahorrás un 50% en comparación a 12 planes mensuales. Ideal para empresas grandes con grandes demandas de personal.',
            'precio' => 1050000,
            'hab_ser' => 1,
        ]);
    }
}
