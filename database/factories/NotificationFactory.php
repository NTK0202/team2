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
//        $published_to = ['all'];
        $published_to = [];
        array_push($published_to, rand(1, 3), rand(4, 6), rand(7,10));
        $published_to = json_encode($published_to);

        return [
            'published_date' => $this->faker->date(),
            'subject' => $this->faker->title(),
            'message' => $this->faker->text(),
            'status' => rand(0, 2),
            'published_to' => $published_to,
            'attachment' => 'python-practice-book.pdf',
            'created_by' => rand(1, 800),
        ];
    }
}
