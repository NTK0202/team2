<?php

namespace Database\Factories;

use App\Models\Worksheet;
use Illuminate\Database\Eloquent\Factories\Factory;

class LateEarlyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->randomElement(Worksheet::pluck('work_date')->toarray());

        return [
            'member_id' => rand(1, 100),
            'request_type' => rand(1, 5),
            'request_for_date' => $date,
            'checkin' => $date.' '. $this->faker->time(),
            'checkout' => $date.' '. $this->faker->time(),
            'leave_all_day' => rand(0, 1),
            'reason' => $this->faker->text(100),
            'status' => rand(-1, 2),
            'manager_confirmed_status' => rand(0, 1),
            'manager_confirmed_comment' => $this->faker->text(100),
            'admin_approved_status' => rand(0,1),
            'admin_approved_comment' => $this->faker->text(100),
            'error_count' => rand(0, 1),
        ];
    }
}
