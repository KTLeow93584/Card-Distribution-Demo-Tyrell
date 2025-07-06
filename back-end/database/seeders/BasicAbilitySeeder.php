<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BasicAbilitySeeder extends Seeder
{
    public function run()
    {
        DB::table('basic_abilities')->insert([
            [
                'id' => 1,
                'name' => '異文化理解力',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'id' => 2,
                'name' => '状況判断力',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]
        ]);
    }
}