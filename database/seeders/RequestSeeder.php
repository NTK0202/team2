<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('requests')->insert([
            'member_id' => 3,
            'request_type' => 4,
            'request_for_date' => '2022-01-11',
            'checkin' => '2022-01-11 09:13:21',
            'checkout' => '2022-01-11 17:30:00',
            'status' => '2',
        ]);

        DB::table('requests')->insert([
            'member_id' => 3,
            'request_type' => 4,
            'request_for_date' => '2022-01-05',
            'checkin' => '2022-01-05 09:36:34',
            'checkout' => '2022-01-05 17:30:00',
            'status' => '0',
        ]);

        DB::table('requests')->insert([
            'member_id' => 3,
            'request_type' => 4,
            'request_for_date' => '2022-01-04',
            'checkin' => '2022-01-04 08:55:48',
            'checkout' => '2022-01-04 17:30:00',
            'status' => '-1',
        ]);
    }
}
