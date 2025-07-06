<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AffiliateSeeder extends Seeder
{
    public function run()
    {
        DB::table('affiliates')->insert([
            [
                'id' => 1,
                'name' => '機内安全設備',
                'type' => 1, // Tools
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'id' => 2,
                'name' => '英語検定1級',
                'type' => 2, // Qualifications for both Rec and Req
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]
        ]);
    }
}