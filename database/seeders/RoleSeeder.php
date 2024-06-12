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
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleModelo = Role::create(['name' => 'modelo']);
        $roleEmpresa = Role::create(['name' => 'empresa']);
        
        $permission = Permission::create(['name' => 'empresas.index'])->assignRole($roleAdmin);
        $permission = Permission::create(['name' => 'modelos.index'])->assignRole($roleAdmin);

        //$permission = Permission::create(['name' => 'empresas.index'])->assignRole($roleEmpresa);
        $permission = Permission::create(['name' => 'empresas.create'])->syncRoles($roleAdmin, $roleEmpresa);
        $permission = Permission::create(['name' => 'empresas.edit'])->syncRoles($roleAdmin, $roleEmpresa);
        $permission = Permission::create(['name' => 'empresas.destroy'])->syncRoles($roleAdmin, $roleEmpresa);

        $permission = Permission::create(['name' => 'modelos.index']);
        $permission = Permission::create(['name' => 'modelos.create']);
        $permission = Permission::create(['name' => 'modelos.edit']);
        $permission = Permission::create(['name' => 'modelos.destroy']);
    }
}
