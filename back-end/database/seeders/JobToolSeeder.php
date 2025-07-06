<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobToolSeeder extends Seeder
{
    public function run()
    {
        DB::table('jobs_tools')->insert([
            [
                'job_id' => 1,
                'affiliate_id' => 1
            ]
        ]);
    }
}