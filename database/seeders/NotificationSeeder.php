<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\Division::factory(10)->create();
//        \App\Models\DivisionMember::factory(200)->create();
        \App\Models\Notification::factory(200)->create();
    }
}
