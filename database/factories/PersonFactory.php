<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $faker->name,
            'document_number' => substr(rand().rand(),0,10),
            'phone' => substr( $faker->phoneNumber,0,10),
            'cell_phone' => substr( $faker->phoneNumber,0,10),
            'address' => substr( $faker->address,0,160),
            'life_here' => 0,
            // 'start_date'=> $faker->dateTimeBetween('now', '+30 years'),
            'start_date'=> Carbon\Carbon::now(),
            'user_id'=> 1,
            'person_type_id'=> rand(1,2),
    
    
    
        ];
    }
}
