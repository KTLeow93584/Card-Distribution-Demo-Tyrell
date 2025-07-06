<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobReqQualificationSeeder extends Seeder
{
    public function run()
    {
        DB::table('jobs_req_qualifications')->insert([
            [
                'job_id' => 1,
                'affiliate_id' => 2
            ]
        ]);
    }
}