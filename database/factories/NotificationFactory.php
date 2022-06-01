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
        $published_to = [];
        $values = rand(1, 800);
        array_push($published_to, $values);
        $published_to = json_encode($published_to);

        return [
            'published_date' => $this->faker->date(),
            'subject' => $this->faker->title(),
            'message' => $this->faker->text(),
            'status' => rand(0, 2),
            'published_to' => $published_to,
            'attachment' => 'https://jes.edu.vn/wp-content/uploads/2017/10/h%C3%ACnh-%E1%BA%A3nh.jpg',
            'created_by' => rand(1, 800),
        ];
    }
}
