<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MemberRequestQuotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\MemberRequestQuota::factory(800)->create();
    }
}
