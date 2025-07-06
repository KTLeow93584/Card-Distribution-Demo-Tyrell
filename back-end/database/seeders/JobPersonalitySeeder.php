<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobPersonalitySeeder extends Seeder
{
    public function run()
    {
        DB::table('jobs_personalities')->insert([
            [
                'job_id' => 1,
                'personality_id' => 1,
            ]
        ]);
    }
}