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
            ['name' => 'Academic Qualification Pre Cas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'English Language Certificate', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Passport Pre Cas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'CV', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Statement Of Purpose', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Work Reference Letter', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Academic Reference Letter', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'TB Certificate', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Conditional Offer', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'UnConditional Offer', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cas Letter', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Other Pre Cas Doc', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Bank Statement', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bank Loan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sponsorship Loan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Government Letter', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Other Financial Doc', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Share Code', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Passport Post Cas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Academic Qualification Post Cas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vignette', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tickets IfEntered ViaE-Gates', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Other Post Cas Doc', 'created_at' => now(), 'updated_at' => now()],

            ['name' => 'Registry Documents', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Compliance Documents', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Other', 'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}
