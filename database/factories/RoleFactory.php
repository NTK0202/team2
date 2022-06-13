<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->randomElement(['Admin','Manager','Member']),
            'created_at'=>$this->faker->dateTimeBetween('-1 day' ),
            'updated_at'=>$this->faker->dateTimeBetween('-1 day' ),
        ];
    }
}
