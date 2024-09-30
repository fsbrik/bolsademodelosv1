<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateUserPasswordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Aplicar a todos los usuarios o puedes agregar condiciones específicas
    $usuarios = User::all(); // Puedes ajustar la consulta según lo que desees

    foreach ($usuarios as $usuario) {
        $usuario->password = Hash::make('123'); // Contraseña fija o generar dinámicamente
        $usuario->save();
    }
}

}
