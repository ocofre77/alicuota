<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PersonTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::Table('person_types')->delete();
        $person_types=[
            array(
                'name' => 'Propietario',
            ),
            array(
                'name' => 'Arrendatario',
            ),
        ];
        DB::Table('person_types')->insert($person_types);

    }
}
