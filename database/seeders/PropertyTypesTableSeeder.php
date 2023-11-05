<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PropertyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::Table('property_types')->delete();
        $propertyTypes=[
            array(
                'name'=>'Casa',
                'created_at'=>date("Y-m-d H:i:s")
            ),
            array(
                'name'=>'Terreno',
                'created_at'=>date("Y-m-d H:i:s")
            ),
            array(
                'name'=>'Departamento',
                'created_at'=>date("Y-m-d H:i:s")
            ),
            array(
                'name'=>'Arriendo',
                'created_at'=>date("Y-m-d H:i:s")
            ),

        ];
        DB::Table('property_types')->insert($propertyTypes);
    }
}
