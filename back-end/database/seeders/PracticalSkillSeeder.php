<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PracticalSkillSeeder extends Seeder
{
    public function run()
    {
        DB::table('practical_skills')->insert([
            [
                'id' => 1,
                'name' => '接客サービス',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'id' => 2,
                'name' => '外国語対応',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]
        ]);
    }
}