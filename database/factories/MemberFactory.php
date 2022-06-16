<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return [
            'member_code' => substr(str_shuffle(str_repeat($pool, 5)), 0, 10),
            'full_name' => $this->faker->name(),
            'email' => 'test'.$this->faker->unique()->numberBetween(500, 600).'@gmail.com',
            'password' => Hash::make('12345678'), // password
            'other_email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'gender' => rand(0, 1),
            'marital_status' => rand(0, 4),
            'birth_date' => $this->faker->date('Y-m-d'),
            'permanent_address' => $this->faker->name(),
            'temporary_address' => $this->faker->name(),
            'identity_number' => rand(100000000000, 999999999999),
            'identity_card_date' => $this->faker->date('Y-m-d'),
            'identity_card_place' => $this->faker->name(),
            'nationality' => $this->faker->name(),
            'emergency_contact_name' => $this->faker->name(),
            'emergency_contact_relationship' => $this->faker->name(),
            'emergency_contact_number' => rand(100000000000, 999999999999),
            'bank_name' => "Agribank",
            'bank_account' => rand(100000000000, 999999999999),
            'status' => rand(-1, 5),
            'created_by' => 1
        ];
    }
}
