<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionPedidoSeeder extends Seeder
{
    public function run(): void
    {
        $roleAdmin = Role::findByName('admin');
        $roleEmpresa = Role::findByName('empresa');
        $roleModelo = Role::findByName('modelo');

        /* Permission::create(['name' => 'pedidos.index'])->assignRole($roleAdmin);
        Permission::create(['name' => 'pedidos.create'])->syncRoles($roleAdmin, $roleEmpresa, $roleModelo);
        Permission::create(['name' => 'pedidos.edit'])->syncRoles($roleAdmin, $roleEmpresa, $roleModelo);
        Permission::create(['name' => 'pedidos.show'])->syncRoles($roleAdmin, $roleEmpresa, $roleModelo);
        Permission::create(['name' => 'pedidos.destroy'])->syncRoles($roleAdmin, $roleEmpresa, $roleModelo); 
        
        // Recuperar el permiso existente
        $permisoPedidosIndex = Permission::findByName('pedidos.index');
        
        // Asignar los roles adicionales al permiso
        $permisoPedidosIndex->assignRole($roleEmpresa);
        $permisoPedidosIndex->assignRole($roleModelo); */
    }
}

