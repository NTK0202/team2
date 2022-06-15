<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CheckLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\CheckLog::factory(30000)->create();
    }
}
