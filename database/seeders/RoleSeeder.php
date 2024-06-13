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
        
        Permission::create(['name' => 'users.index'])->assignRole($roleAdmin);
        Permission::create(['name' => 'empresas.index'])->assignRole($roleAdmin);
        Permission::create(['name' => 'modelos.index'])->assignRole($roleAdmin);

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

        //Permission::create(['name' => 'modelos.index'])->syncRoles($roleAdmin, $roleModelo);
        Permission::create(['name' => 'modelos.create'])->syncRoles($roleAdmin, $roleModelo);
        Permission::create(['name' => 'modelos.edit'])->syncRoles($roleAdmin, $roleModelo);
        Permission::create(['name' => 'modelos.show'])->syncRoles($roleAdmin, $roleModelo);
        Permission::create(['name' => 'modelos.destroy'])->syncRoles($roleAdmin, $roleModelo);
    }
}
