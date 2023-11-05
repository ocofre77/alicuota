<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Role::create(['name' => 'admin', 'guard_name' => 'Administrador']);
         Role::create(['name' => 'manager', 'guard_name' => 'Gerente']);
         Role::create(['name' => 'accountant', 'guard_name' => 'Contador']);
         Role::create(['name' => 'treasurer', 'guard_name' => 'Tesorero']);

        // Role::create(['name','manager']);
        // Role::create(['name','accountant']);
        // Role::create(['name','treasurer']);
    }
}
