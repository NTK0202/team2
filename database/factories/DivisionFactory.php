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
        return [
            'division_name' => $this->faker->name(),
            'dm_id' => $this->faker->unique()->numberBetween(1, 10),
            'status' => rand(1, 2),
            'created_by' => rand(1, 200),
        ];
    }
}
