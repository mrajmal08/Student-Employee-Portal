<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CaseStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('case_statuses')->insert([
            [
                'name' => 'Created',
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
