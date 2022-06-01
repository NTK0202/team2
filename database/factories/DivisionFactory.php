<?php

namespace Database\Factories;

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
        return [
            'division_name' => $this->faker->name(),
            'dm_id' => $this->faker->unique()->numberBetween(1,800),
            'status' => rand(1, 2),
            'created_by' => rand(1, 800),
        ];
    }
}
