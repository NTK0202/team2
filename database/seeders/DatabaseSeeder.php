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

        DB::table('roles')->insert([
            'title' => 'Admin',
        ]);

        DB::table('roles')->insert([
            'title' => 'Manager',
        ]);

        DB::table('roles')->insert([
            'title' => 'Member',
        ]);

        \App\Models\Member::factory(800)->create();
        \App\Models\MemberRole::factory(800)->create();
        \App\Models\Worksheet::factory(800)->create();
        \App\Models\Division::factory(10)->create();
    }
}
