<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    public function run()
    {
        DB::table('jobs')->insert([
            [
                'id' => 1,
                'name' => 'キャビンアテンダント',
                'media_id' => 1,
                'job_category_id' => 1,
                'job_type_id' => 1,
                'description' => 'キャビンアテンダントの仕事内容',
                'detail' => '航空会社でのキャビンアテンダント業務',
                'business_skill' => '接客スキル',
                'knowledge' => '航空業界の知識',
                'location' => '東京',
                'activity' => '機内サービス',
                'academic_degree_doctor' => false,
                'academic_degree_master' => false,
                'academic_degree_professional' => true,
                'academic_degree_bachelor' => true,
                'salary_statistic_group' => '航空業界',
                'salary_range_first_year' => '300万円',
                'salary_range_average' => '450万円',
                'salary_range_remarks' => '経験による',
                'restriction' => '要英語力',
                'estimated_total_workers' => 1000,
                'remarks' => '未経験可',
                'url' => 'https://example.com/jobs/1',
                'seo_description' => 'キャビンアテンダント求人',
                'seo_keywords' => 'CA,航空,客室乗務員',
                'sort_order' => 1,
                'publish_status' => 1,
                'version' => 1,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]
        ]);
    }
}