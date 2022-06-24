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
        $attachment = ['Relipa_Portal.docx', 'relipa_portal_SRS_v1.0.xlsx', 'test.txt', 'test_attachment.zip', 'python-practice-book.pdf'];

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
            'subject' => $this->faker->text(38),
            'message' => $this->faker->text(20000),
            'status' => rand(0, 2),
            'published_to' => $published_to,
            'attachment' => $this->faker->randomElement($attachment),
            'created_by' => rand(1, 100),
        ];
    }
}
