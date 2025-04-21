<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'Supper Admin',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Recruitment Agent',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Head of Sale',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Sales Support',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Head of Admissions',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Admin Support',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Compliance Support',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Head Of Registry',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
            [
                'name' => 'Registry Support',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
        ]);
    }
}
