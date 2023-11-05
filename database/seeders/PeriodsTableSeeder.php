<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //DB::Table('periods')->delete();


        $years = [2010,2011,2012,2013,2014,2015,2016,2017,2018,2019,2020];
        $months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

        $periods=[];
        foreach ($years as $year) {
            $index = 1;
            foreach ($months as $month) {
                array_push(
                    $periods,
                    array(
                        'year'=> $year,
                        'month_id' => $index, 'month_name' => $months[$index-1],
                        'created_at'=>date("Y-m-d H:i:s")
                    )
                );
                $index++;
            }
        }
        DB::Table('periods')->insert($periods);
    }
}
