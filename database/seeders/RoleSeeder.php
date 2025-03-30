<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*$roleAdmin = Role::create(['name' => 'admin']);
        $roleModelo = Role::create(['name' => 'modelo']);
        $roleEmpresa = Role::create(['name' => 'empresa']);
        
        Permission::create(['name' => 'users.index'])->assignRole($roleAdmin);
        Permission::create(['name' => 'empresas.index'])->assignRole($roleAdmin);
        Permission::create(['name' => 'modelos.index'])->syncRoles($roleAdmin, $roleEmpresa);

        //Permission::create(['name' => 'users.index'])->assignRole($roleEmpresa);
        //Permission::create(['name' => 'users.create'])->syncRoles($roleAdmin);
        Permission::create(['name' => 'users.edit'])->syncRoles($roleAdmin);
        Permission::create(['name' => 'users.show'])->syncRoles($roleAdmin);
        Permission::create(['name' => 'users.destroy'])->syncRoles($roleAdmin);

        //Permission::create(['name' => 'empresas.index'])->assignRole($roleEmpresa);
        Permission::create(['name' => 'empresas.create'])->syncRoles($roleAdmin, $roleEmpresa);
        Permission::create(['name' => 'empresas.edit'])->syncRoles($roleAdmin, $roleEmpresa);
        Permission::create(['name' => 'empresas.show'])->syncRoles($roleAdmin, $roleEmpresa);
        Permission::create(['name' => 'empresas.destroy'])->syncRoles($roleAdmin, $roleEmpresa);

        Permission::create(['name' => 'modelos.index'])->syncRoles($roleAdmin, $roleModelo, $roleEmpresa);
        Permission::create(['name' => 'modelos.create'])->syncRoles($roleAdmin, $roleModelo);
        Permission::create(['name' => 'modelos.edit'])->syncRoles($roleAdmin, $roleModelo);
        Permission::create(['name' => 'modelos.show'])->syncRoles($roleAdmin, $roleModelo, $roleEmpresa);
        Permission::create(['name' => 'modelos.destroy'])->syncRoles($roleAdmin, $roleModelo); 

        Permission::create(['name' => 'modelos.datos_de_contacto'])->syncRoles($roleAdmin);     
        Permission::create(['name' => 'modelos.ficha_tecnica'])->syncRoles($roleEmpresa);*/

        $roleEmpresa = Role::findByName('empresa'); 
        $roleAdmin = Role::findByName('admin');
        $roleModelo = Role::findByName('modelo');
        //$permisoVerEstado = Permission::findByName('modelos.ver_estado');
        //$permisoVerEstado->syncRoles($roleAdmin, $roleModelo);
        //Permission::create(['name' => 'modelos.ver_estado'])->syncRoles($roleAdmin, $roleModelo);
        //Permission::create(['name' => 'modelos.ver_habilitar'])->syncRoles($roleAdmin);
        //Permission::create(['name' => 'modelos.solicitudes_modelos'])->syncRoles($roleAdmin);
        //Permission::create(['name' => 'modelos.permite_editar'])->syncRoles($roleAdmin);

        //Permission::create(['name' => 'modelos.filtros_administrador'])->assignRole('admin');
        //Permission::create(['name' => 'modelos.subir_fotos'])->assignRole('admin');
        //Permission::create(['name' => 'modelos.eliminar_fotos'])->assignRole('admin');
        //Permission::create(['name' => 'empresas.contratar_modelos'])->syncRoles($roleAdmin, $roleEmpresa);
        
        /* Permission::create(['name' => 'servicios.index'])->assignRole($roleAdmin);
        Permission::create(['name' => 'servicios.create'])->assignRole($roleAdmin);
        Permission::create(['name' => 'servicios.edit'])->assignRole($roleAdmin);
        Permission::create(['name' => 'servicios.show'])->syncRoles($roleAdmin);
        Permission::create(['name' => 'servicios.destroy'])->syncRoles($roleAdmin); */

        /* Permission::create(['name' => 'modelos.contrataciones.index'])->syncRoles($roleAdmin, $roleModelo);
        Permission::create(['name' => 'empresas.contrataciones.index'])->syncRoles($roleAdmin, $roleEmpresa);
        Permission::create(['name' => 'empresas.contrataciones.create'])->syncRoles($roleAdmin, $roleEmpresa);
        Permission::create(['name' => 'empresas.contrataciones.edit'])->syncRoles($roleAdmin, $roleEmpresa);
        Permission::create(['name' => 'modelos.contrataciones.show'])->syncRoles($roleAdmin, $roleModelo);
        Permission::create(['name' => 'empresas.contrataciones.show'])->syncRoles($roleAdmin, $roleEmpresa); */

        Permission::create(['name' => 'planes.index'])->syncRoles($roleAdmin, $roleEmpresa);
        Permission::create(['name' => 'planes.create'])->syncRoles($roleAdmin, $roleEmpresa);

        
    }
}
