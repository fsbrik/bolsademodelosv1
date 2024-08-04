<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionEmpresaSeeder extends Seeder
{
    public function run(): void
    {
        $roleEmpresa = Role::findByName('empresa');
        
        // Recuperar el permiso existente
        $permisoEmpresaIndex = Permission::findByName('empresas.index');
        
        // Asignar el rol adicionales al permiso
        $permisoEmpresaIndex->assignRole($roleEmpresa);

    }
}

