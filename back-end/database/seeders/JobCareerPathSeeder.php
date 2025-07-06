<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobCareerPathSeeder extends Seeder
{
    public function run()
    {
        DB::table('jobs_career_paths')->insert([
            [
                'job_id' => 1,
                'affiliate_id' => 1
            ]
        ]);
    }
}