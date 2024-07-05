<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicios = [
            ['nom_ser' => 'Book de fotos', 'cat_ser' => 'modelo', 'des_ser' => 'la producción de fotos para tu book', 'precio' => 50000, 'hab_ser' => true],
            ['nom_ser' => 'Fotos extra', 'cat_ser' => 'modelo', 'des_ser' => 'subimos todas las fotos a tu perfil', 'precio' => 20000, 'hab_ser' => true],
            ['nom_ser' => 'Video', 'cat_ser' => 'modelo', 'des_ser' => 'la producción de un video para tu instagram, tiktok y youtube', 'precio' => 50000, 'hab_ser' => true],
            ['nom_ser' => 'Redes sociales', 'cat_ser' => 'modelo', 'des_ser' => 'incluimos tu perfil en nuestras redes sociales', 'precio' => 0, 'hab_ser' => true],
            ['nom_ser' => 'Contacto', 'cat_ser' => 'empresa', 'des_ser' => 'nos encargamos de hacer el primer contacto con el/la modelo y chequeamos su disponibilidad para el trabajo requerido', 'precio' => 30000, 'hab_ser' => true],
            ['nom_ser' => 'Hora de estudio', 'cat_ser' => 'empresa', 'des_ser' => 'contratá nuestro espacio y la producción fotográfica por hora (no incluye el/la modelo)', 'precio' => 50000, 'hab_ser' => true],
            ['nom_ser' => 'Media jornada', 'cat_ser' => 'empresa', 'des_ser' => 'contratá nuestro espacio y la producción fotográfica por 4 horas (no incluye el/la modelo)', 'precio' => 180000, 'hab_ser' => true],
            ['nom_ser' => 'Jornada completa', 'cat_ser' => 'empresa', 'des_ser' => 'contratá nuestro espacio y la producción fotográfica por 8 horas (no incluye el/la modelo)', 'precio' => 320000, 'hab_ser' => true],
        ];

        foreach ($servicios as $servicio) {
            Servicio::create($servicio);
        }
    }
}
