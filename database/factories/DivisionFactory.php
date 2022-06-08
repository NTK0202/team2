<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class DivisionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $division_name = ['D1', 'D2', 'D3', 'D4', 'D5', 'D6', 'D7', 'D8', 'D9', 'D10'];

        return [
            'division_name' => $this->faker->unique()->randomElement($division_name),
            'dm_id' => $this->faker->unique()->numberBetween(1, 10),
            'status' => rand(1, 2),
            'created_by' => rand(1, 800),
        ];
    }
}
