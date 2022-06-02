<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'published_date' => $this->faker->date(),
            'subject' => $this->faker->title(),
            'message' => $this->faker->text(),
            'status' => rand(0, 2),
            'attachment' => 'https://jes.edu.vn/wp-content/uploads/2017/10/h%C3%ACnh-%E1%BA%A3nh.jpg',
            'created_by' => rand(1, 800),
        ];
    }
}
