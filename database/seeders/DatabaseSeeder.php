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

        \App\Models\Member::factory(100)->create();
        \App\Models\MemberRole::factory(100)->create();
        \App\Models\Division::factory(6)->create();
        \App\Models\DivisionMember::factory(100)->create();
    }
}
