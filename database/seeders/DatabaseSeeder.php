<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Member::factory(800)->create();
        \App\Models\Role::factory(3)->create();
        \App\Models\MemberRole::factory(800)->create();
        \App\Models\Worksheet::factory(50000)->create();
        \App\Models\Division::factory(6)->create();
        \App\Models\DivisionMember::factory(800)->create();
        \App\Models\MemberRequestQuota::factory(4000)->create();
        \App\Models\CheckLog::factory(100000)->create();
        \App\Models\Notification::factory(500)->create();
    }
}
