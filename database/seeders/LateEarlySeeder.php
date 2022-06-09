<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LateEarlySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\LateEarly::factory(10)->create();
    }
}
