<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WorksheetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $member_id = Member::pluck('id')->toArray();
        $work_date =$this->faker->date();

        return [
            'member_id' => $this->faker->randomElement($member_id),
            'work_date' => $work_date,
            'checkin' => $work_date.' '.$this->faker->time(),
            'checkin_original' => $work_date.' '.$this->faker->time(),
            'checkout' => $work_date.' '.$this->faker->time(),
            'checkout_original' => $work_date.' '.$this->faker->time(),
            'late' => $this->faker->date('H:i'),
            'early' => $this->faker->date('H:i'),
            'in_office' => $this->faker->date('H:i'),
            'ot_time' => $this->faker->date('H:i'),
            'work_time' => $this->faker->date('H:i'),
            'lack' => $this->faker->date('H:i'),
            'compensation' => $this->faker->date('H:i'),
            'paid_leave' => $this->faker->date('H:i'),
            'unpaid_leave' => $this->faker->date('H:i'),
            'note' => $this->faker->name(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {

            return [
                'email_verified_at' => null,
            ];
        });
    }
}
