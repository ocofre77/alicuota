<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PersonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
         DB::Table('persons')->delete();
         factory(App\Models\Person::class)->times(250)->create();

    }
}
