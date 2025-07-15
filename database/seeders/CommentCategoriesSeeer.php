<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CommentCategoriesSeeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            [
                'id' => 1,
                'name' => 'Case',
                'slug' => 'case',
                'created_by' => null,
                'updated_by' => null,
                'deleted_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'Student',
                'slug' => 'student',
                'created_by' => null,
                'updated_by' => null,
                'deleted_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'name' => 'Document',
                'slug' => 'document',
                'created_by' => null,
                'updated_by' => null,
                'deleted_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'name' => 'Finance',
                'slug' => 'finance',
                'created_by' => null,
                'updated_by' => null,
                'deleted_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'name' => 'Credibility Interview',
                'slug' => 'credibility_interview',
                'created_by' => null,
                'updated_by' => null,
                'deleted_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'name' => 'UKVI Compliance',
                'slug' => 'ukvi_compliance',
                'created_by' => null,
                'updated_by' => null,
                'deleted_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 7,
                'name' => 'Enrolment',
                'slug' => 'nnrolment',
                'created_by' => null,
                'updated_by' => null,
                'deleted_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 8,
                'name' => 'Registry',
                'slug' => 'registry',
                'created_by' => null,
                'updated_by' => null,
                'deleted_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
