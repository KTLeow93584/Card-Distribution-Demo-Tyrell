<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class JobsSystemSeeder extends Seeder
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
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // foreach ($this->tables as $table) {
        //     DB::table($table)->truncate();
        // }
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = Faker::create('ja_JP');
        
        // Seed job categories (10 categories)
        $jobCategories = [];
        for ($i = 1; $i <= 10; $i++) {
            $jobCategories[] = [
                'name' => $faker->jobTitle . '部門',
                'sort_order' => $i,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('job_categories')->insert($jobCategories);

        // Seed job types (50 types)
        $jobTypes = [];
        for ($i = 1; $i <= 50; $i++) {
            $jobTypes[] = [
                'name' => $faker->jobTitle,
                'job_category_id' => rand(1, 10),
                'sort_order' => $i,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('job_types')->insert($jobTypes);

        // Seed personalities (20 records)
        $personalities = [];
        for ($i = 1; $i <= 20; $i++) {
            $personalities[] = [
                'name' => $faker->word,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('personalities')->insert($personalities);

        // Seed practical skills (30 records)
        $practicalSkills = [];
        for ($i = 1; $i <= 30; $i++) {
            $practicalSkills[] = [
                'name' => $faker->jobTitle . 'スキル',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('practical_skills')->insert($practicalSkills);

        // Seed basic abilities (15 records)
        $basicAbilities = [];
        for ($i = 1; $i <= 15; $i++) {
            $basicAbilities[] = [
                'name' => $faker->word . 'の能力',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('basic_abilities')->insert($basicAbilities);

        // Seed affiliates (100 records)
        $affiliates = [];
        for ($i = 1; $i <= 100; $i++) {
            $affiliates[] = [
                'name' => $faker->company,
                'type' => rand(1, 3),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('affiliates')->insert($affiliates);

        // Seed jobs (10,000 records) in chunks
        $chunkSize = 10;
        for ($chunk = 0; $chunk < 10; $chunk++) {
            $jobs = [];
            for ($i = 1; $i <= $chunkSize; $i++) {
                $jobs[] = [
                    'name' => $faker->jobTitle,
                    'media_id' => rand(1, 100),
                    'job_category_id' => rand(1, 10),
                    'job_type_id' => rand(1, 50),
                    'description' => $faker->paragraph,
                    'detail' => $faker->text(500),
                    'business_skill' => $faker->text(200),
                    'knowledge' => $faker->text(200),
                    'location' => $faker->city,
                    'activity' => $faker->text(200),
                    'academic_degree_doctor' => rand(0, 1),
                    'academic_degree_master' => rand(0, 1),
                    'academic_degree_professional' => rand(0, 1),
                    'academic_degree_bachelor' => rand(0, 1),
                    'salary_statistic_group' => $faker->numberBetween(300000, 800000),
                    'salary_range_first_year' => $faker->numberBetween(200000, 400000),
                    'salary_range_average' => $faker->numberBetween(400000, 800000),
                    'salary_range_remarks' => $faker->sentence,
                    'restriction' => $faker->sentence,
                    'estimated_total_workers' => rand(10, 1000),
                    'remarks' => $faker->text(200),
                    'url' => $faker->url,
                    'seo_description' => $faker->text(200),
                    'seo_keywords' => implode(',', $faker->words(5)),
                    'sort_order' => $chunk * $chunkSize + $i,
                    'publish_status' => 1,
                    'version' => 1,
                    'created_by' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            DB::table('jobs')->insert($jobs);

            // Get the range of job IDs for this chunk
            $jobIds = range($chunk * $chunkSize + 1, ($chunk + 1) * $chunkSize);

            // Personalities pivot
            $personalitiesPivot = [];
            foreach ($jobIds as $jobId) {
                $personalityIds = range(1, 20);
                shuffle($personalityIds);
                $selectedCount = rand(1, 5);
                $selectedPersonalities = array_slice($personalityIds, 0, $selectedCount);
                
                foreach ($selectedPersonalities as $personalityId) {
                    $personalitiesPivot[] = [
                        'job_id' => $jobId,
                        'personality_id' => $personalityId
                    ];
                }
            }
            DB::table('jobs_personalities')->insert($personalitiesPivot);

            // Practical Skills pivot
            $practicalSkillsPivot = [];
            foreach ($jobIds as $jobId) {
                $skillIds = range(1, 30);
                shuffle($skillIds);
                $selectedCount = rand(1, 8);
                $selectedSkills = array_slice($skillIds, 0, $selectedCount);
                
                foreach ($selectedSkills as $skillId) {
                    $practicalSkillsPivot[] = [
                        'job_id' => $jobId,
                        'practical_skill_id' => $skillId
                    ];
                }
            }
            DB::table('jobs_practical_skills')->insert($practicalSkillsPivot);

            // Basic Abilities pivot
            $basicAbilitiesPivot = [];
            foreach ($jobIds as $jobId) {
                $abilityIds = range(1, 15);
                shuffle($abilityIds);
                $selectedCount = rand(1, 5);
                $selectedAbilities = array_slice($abilityIds, 0, $selectedCount);
                
                foreach ($selectedAbilities as $abilityId) {
                    $basicAbilitiesPivot[] = [
                        'job_id' => $jobId,
                        'basic_ability_id' => $abilityId
                    ];
                }
            }
            DB::table('jobs_basic_abilities')->insert($basicAbilitiesPivot);

            // Tools pivot
            $toolsPivot = [];
            foreach ($jobIds as $jobId) {
                $toolIds = range(1, 100);
                shuffle($toolIds);
                $selectedCount = rand(1, 10);
                $selectedTools = array_slice($toolIds, 0, $selectedCount);
                
                foreach ($selectedTools as $toolId) {
                    $toolsPivot[] = [
                        'job_id' => $jobId,
                        'affiliate_id' => $toolId
                    ];
                }
            }
            DB::table('jobs_tools')->insert($toolsPivot);

            // Career Paths pivot
            $careerPathsPivot = [];
            foreach ($jobIds as $jobId) {
                $pathIds = range(1, 100);
                shuffle($pathIds);
                $selectedCount = rand(1, 5);
                $selectedPaths = array_slice($pathIds, 0, $selectedCount);
                
                foreach ($selectedPaths as $pathId) {
                    $careerPathsPivot[] = [
                        'job_id' => $jobId,
                        'affiliate_id' => $pathId
                    ];
                }
            }
            DB::table('jobs_career_paths')->insert($careerPathsPivot);

            // Recommended Qualifications pivot
            $recQualificationsPivot = [];
            foreach ($jobIds as $jobId) {
                $qualificationIds = range(1, 100);
                shuffle($qualificationIds);
                $selectedCount = rand(1, 7);
                $selectedQualifications = array_slice($qualificationIds, 0, $selectedCount);
                
                foreach ($selectedQualifications as $qualificationId) {
                    $recQualificationsPivot[] = [
                        'job_id' => $jobId,
                        'affiliate_id' => $qualificationId
                    ];
                }
            }
            DB::table('jobs_rec_qualifications')->insert($recQualificationsPivot);

            // Required Qualifications pivot
            $reqQualificationsPivot = [];
            foreach ($jobIds as $jobId) {
                $qualificationIds = range(1, 100);
                shuffle($qualificationIds);
                $selectedCount = rand(1, 3);
                $selectedQualifications = array_slice($qualificationIds, 0, $selectedCount);
                
                foreach ($selectedQualifications as $qualificationId) {
                    $reqQualificationsPivot[] = [
                        'job_id' => $jobId,
                        'affiliate_id' => $qualificationId
                    ];
                }
            }
            DB::table('jobs_req_qualifications')->insert($reqQualificationsPivot);
        }
    }
}
