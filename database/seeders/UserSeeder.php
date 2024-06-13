<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //$users = User::factory()->count(20)->create();
        /* User::create([
            'id' => 1,
            'name' => 'admin',
            'email' => 'fsbrik@hotmail.com',
            'password' => Hash::make('123')
        ])->assignRole('admin'); */
        $users = User::whereBetween('id', [37, 75])->get();//->orWhereBetween('id', [9, 24])->get();

        foreach ($users as $user) {
            $user->assignRole('modelo');
        }
    }
}
