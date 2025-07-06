<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobPracticalSkillSeeder extends Seeder
{
    public function run()
    {
        DB::table('jobs_practical_skills')->insert([
            [
                'job_id' => 1,
                'practical_skill_id' => 1
            ],
            [
                'job_id' => 1,
                'practical_skill_id' => 2
            ]
        ]);
    }
}