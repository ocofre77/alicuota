<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lot_number' => rand(1,400),
            //'note' => $faker->sentence($nbWords = 4, $variableNbWords = true),
            'note' => fake()->name(),
            'address' =>  fake()->name(),
            'active' => 1,
            'property_type_id' =>rand(1,3),
        ];
    }
}
