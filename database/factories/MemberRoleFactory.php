<?php

namespace Database\Factories;

use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class MemberRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $memberId = 1;
        $roleId = DB::table('roles')->pluck('id');
        return [
            'role_id' => $this->faker->randomElement($roleId),
            'member_id' => $memberId++,
        ];
    }
}
