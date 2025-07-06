<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobBasicAbilitySeeder extends Seeder
{
    public function run()
    {
        DB::table('jobs_basic_abilities')->insert([
            [
                'job_id' => 1,
                'basic_ability_id' => 1
            ],
            [
                'job_id' => 1,
                'basic_ability_id' => 2
            ]
        ]);
    }
}