<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\Worksheet;
use Illuminate\Database\Eloquent\Factories\Factory;

class CheckLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $memberId = Member::pluck('id')->toarray();
        $workDate = Worksheet::pluck('work_date')->toarray();
        $date = $this->faker->randomElement($workDate);

        return [
            'member_id' => $this->faker->unique()->randomElement($memberId),
            'checktime' => $date.' '.$this->faker->time(),
            'date' => $date,
        ];
    }
}
