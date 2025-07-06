<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobRecQualificationSeeder extends Seeder
{
    public function run()
    {
        DB::table('jobs_rec_qualifications')->insert([
            [
                'job_id' => 1,
                'affiliate_id' => 2
            ]
        ]);
    }
}