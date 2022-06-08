<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WorksheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Worksheet::factory(800)->create();
        \App\Models\CheckLog::factory(800)->create();
    }
}
