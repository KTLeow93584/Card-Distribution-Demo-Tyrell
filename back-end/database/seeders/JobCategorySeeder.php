<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobCategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('job_categories')->insert([
            [
                'id' => 1,
                'name' => 'キャビンアテンダント',
                'sort_order' => 1,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]
        ]);
    }
}