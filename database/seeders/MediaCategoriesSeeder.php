<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('media_categories')->insert([
            ['name' => 'General Documents', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Academic Documents', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Academic Qualification', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'English Language Certificate', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'English Language Verification Certificate', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Passport', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'CV', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Academic Reference Letter', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Work Reference Letter', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Statement Of Purpose', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'TB Certificate', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Other Documents', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
