<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('job_types')->insert([
            [
                'id' => 1,
                'name' => 'キャビンアテンダント専門職',
                'job_category_id' => 1,
                'sort_order' => 1,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]
        ]);
    }
}