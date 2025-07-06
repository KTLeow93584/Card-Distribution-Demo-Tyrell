<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClearJobSystemSeeder extends Seeder
{
    protected $tables = [
        'jobs_req_qualifications',
        'jobs_rec_qualifications',
        'jobs_career_paths',
        'jobs_tools',
        'jobs_basic_abilities',
        'jobs_practical_skills',
        'jobs_personalities',
        'jobs',
        'affiliates',
        'basic_abilities',
        'practical_skills',
        'personalities',
        'job_types',
        'job_categories'
    ];

    public function run()
    {
        // Auto truncate all tables in correct order
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
