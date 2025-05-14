<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class InterviewStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('interview_statuses')->insert([
            [
                'name' => 'Interview Created',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Interview Scheduled',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Interview Done',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Compliance Interview Created',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Compliance Interview Scheduled',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Compliance Interview Done',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],

        ]);
    }
}
