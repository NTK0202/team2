<?php

namespace Database\Factories;

use App\Models\Division;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class DivisionMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $memberId = Member::pluck('id')->toarray();

        return [
            'member_id' => $this->faker->unique()->randomElement($memberId),
            'division_id' => rand(1, 10),
        ];
    }
}
