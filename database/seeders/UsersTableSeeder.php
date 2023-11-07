<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::Table('users')->delete();

        $users = [
            array(
                'name'=> 'Orlando Cofre',
                'email' => 'orlando.cofre77@gmail.com',
                'password' => bcrypt("admin1234"),
                'remember_token' => bcrypt("admin1234"),
                'created_at'=>date("Y-m-d H:i:s")
            ),
            array(
                'name'=> 'Cecilia Nazate',
                'email' => 'cecilia_nazate@live.com',
                'password' => bcrypt("admin1234"),
                'remember_token' => bcrypt("admin1234"),
                'created_at'=>date("Y-m-d H:i:s")
            ),
        ];

        DB::Table('users')->insert($users);

        // factory(App\Models\User::class)->times(50)->create();
        User::factory()->count(30000)->create();

    }
}
