<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class FinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::Table('fines')->delete();
        $fines=[
            array(
                'value' => 10,
                'description'=>'Multa por minga',
                'created_at'=>date("Y-m-d H:i:s")
            ),
            array(
                'value' => 10,
                'description'=>'Multa por no asistencia sesión',
                'created_at'=>date("Y-m-d H:i:s")
            ),
        ];
        DB::Table('fines')->insert($fines);
    }
}
