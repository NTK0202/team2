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
        static $id = 0;
        $id++;

        if ($id % 2 == 0) {
            $published_to = [];
            array_push($published_to, rand(1, 2), rand(3, 4), rand(5, 6));
            $published_to = json_encode($published_to);
        } else {
            $published_to = ['all'];
            $published_to = json_encode($published_to);
        }

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
