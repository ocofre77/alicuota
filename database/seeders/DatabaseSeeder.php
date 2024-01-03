<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use Faker\Factory as Faker;

use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // public function run()
    // {
    //     $this->call(RolesTableSeeder::class);
    //     $this->call(UsersTableSeeder::class);
    //     $this->call(FinesTableSeeder::class);
    //     $this->call(PeriodsTableSeeder::class);
    //     $this->call(PropertyTypesTableSeeder::class);
    //     $this->call(PersonTypesTableSeeder::class);
    //     //$this->call(PersonsTableSeeder::class);
    //     $this->call(AliquotValuesTableSeeder::class);

    // }

    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 200; $i++) {
            DB::table('blogs')->insert([
                'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'description' => $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
                'content' => $faker->text($maxNbChars = 500),
            ]);
        }
    }

}
