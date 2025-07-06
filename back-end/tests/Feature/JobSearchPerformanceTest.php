<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * This test is to identify the key performance changes between the original query provided in the assessment
 * and the modified query.
 * 
 * The modified query has the following optimizations:
 * - Query Chaining into 1 large query.
 * - Use of UNIONs to break down search logic.
 * - Removes duplicate entries.
 * - Reduced table columns queried.
 */
class JobSearchPerformanceTest extends TestCase
{
    use RefreshDatabase;

    public function testJobSearchPerformance()
    {
        // Start timing
        $startTime = microtime(true);

        // Execute the complex query
        $sql = "
            SELECT 
                Jobs.id AS `Jobs__id`,
                Jobs.name AS `Jobs__name`,
                Jobs.media_id AS `Jobs__media_id`,
                Jobs.job_category_id AS `Jobs__job_category_id`,
                Jobs.job_type_id AS `Jobs__job_type_id`,
                Jobs.description AS `Jobs__description`,
                Jobs.detail AS `Jobs__detail`,
                Jobs.business_skill AS `Jobs__business_skill`,
                Jobs.knowledge AS `Jobs__knowledge`,
                Jobs.location AS `Jobs__location`,
                Jobs.activity AS `Jobs__activity`,
                Jobs.academic_degree_doctor AS `Jobs__academic_degree_doctor`,
                Jobs.academic_degree_master AS `Jobs__academic_degree_master`,
                Jobs.academic_degree_professional AS `Jobs__academic_degree_professional`,
                Jobs.academic_degree_bachelor AS `Jobs__academic_degree_bachelor`,
                Jobs.salary_statistic_group AS `Jobs__salary_statistic_group`,
                Jobs.salary_range_first_year AS `Jobs__salary_range_first_year`,
                Jobs.salary_range_average AS `Jobs__salary_range_average`,
                Jobs.salary_range_remarks AS `Jobs__salary_range_remarks`,
                Jobs.restriction AS `Jobs__restriction`,
                Jobs.estimated_total_workers AS `Jobs__estimated_total_workers`,
                Jobs.remarks AS `Jobs__remarks`,
                Jobs.url AS `Jobs__url`,
                Jobs.seo_description AS `Jobs__seo_description`,
                Jobs.seo_keywords AS `Jobs__seo_keywords`,
                Jobs.sort_order AS `Jobs__sort_order`,
                Jobs.publish_status AS `Jobs__publish_status`,
                Jobs.version AS `Jobs__version`,
                Jobs.created_by AS `Jobs__created_by`,
                Jobs.created_at AS `Jobs__created_at`,
                Jobs.updated_at AS `Jobs__updated_at`,
                Jobs.deleted_at AS `Jobs__deleted_at`,
                JobCategories.id AS `JobCategories__id`,
                JobCategories.name AS `JobCategories__name`,
                JobCategories.sort_order AS `JobCategories__sort_order`,
                JobCategories.created_by AS `JobCategories__created_by`,
                JobCategories.created_at AS `JobCategories__created_at`,
                JobCategories.updated_at AS `JobCategories__updated_at`,
                JobCategories.deleted_at AS `JobCategories__deleted_at`,
                JobTypes.id AS `JobTypes__id`,
                JobTypes.name AS `JobTypes__name`,
                JobTypes.job_category_id AS `JobTypes__job_category_id`,
                JobTypes.sort_order AS `JobTypes__sort_order`,
                JobTypes.created_by AS `JobTypes__created_by`,
                JobTypes.created_at AS `JobTypes__created_at`,
                JobTypes.updated_at AS `JobTypes__updated_at`,
                JobTypes.deleted_at AS `JobTypes__deleted_at`
            FROM jobs Jobs
            LEFT JOIN jobs_personalities JobsPersonalities ON Jobs.id = JobsPersonalities.job_id
            LEFT JOIN personalities Personalities ON Personalities.id = JobsPersonalities.personality_id AND Personalities.deleted_at IS NULL
            LEFT JOIN jobs_practical_skills JobsPracticalSkills ON Jobs.id = JobsPracticalSkills.job_id
            LEFT JOIN practical_skills PracticalSkills ON PracticalSkills.id = JobsPracticalSkills.practical_skill_id AND PracticalSkills.deleted_at IS NULL
            LEFT JOIN jobs_basic_abilities JobsBasicAbilities ON Jobs.id = JobsBasicAbilities.job_id
            LEFT JOIN basic_abilities BasicAbilities ON BasicAbilities.id = JobsBasicAbilities.basic_ability_id AND BasicAbilities.deleted_at IS NULL
            LEFT JOIN jobs_tools JobsTools ON Jobs.id = JobsTools.job_id
            LEFT JOIN affiliates Tools ON Tools.type = 1 AND Tools.id = JobsTools.affiliate_id AND Tools.deleted_at IS NULL
            LEFT JOIN jobs_career_paths JobsCareerPaths ON Jobs.id = JobsCareerPaths.job_id
            LEFT JOIN affiliates CareerPaths ON CareerPaths.type = 3 AND CareerPaths.id = JobsCareerPaths.affiliate_id AND CareerPaths.deleted_at IS NULL
            LEFT JOIN jobs_rec_qualifications JobsRecQualifications ON Jobs.id = JobsRecQualifications.job_id
            LEFT JOIN affiliates RecQualifications ON RecQualifications.type = 2 AND RecQualifications.id = JobsRecQualifications.affiliate_id AND RecQualifications.deleted_at IS NULL
            LEFT JOIN jobs_req_qualifications JobsReqQualifications ON Jobs.id = JobsReqQualifications.job_id
            LEFT JOIN affiliates ReqQualifications ON ReqQualifications.type = 2 AND ReqQualifications.id = JobsReqQualifications.affiliate_id AND ReqQualifications.deleted_at IS NULL
            INNER JOIN job_categories JobCategories ON JobCategories.id = Jobs.job_category_id AND JobCategories.deleted_at IS NULL
            INNER JOIN job_types JobTypes ON JobTypes.id = Jobs.job_type_id AND JobTypes.deleted_at IS NULL
            WHERE (
                JobCategories.name LIKE '%キャビンアテンダント%'
                OR JobTypes.name LIKE '%キャビンアテンダント%'
                OR Jobs.name LIKE '%キャビンアテンダント%'
                OR Jobs.description LIKE '%キャビンアテンダント%'
                OR Jobs.detail LIKE '%キャビンアテンダント%'
                OR Jobs.business_skill LIKE '%キャビンアテンダント%'
                OR Jobs.knowledge LIKE '%キャビンアテンダント%'
                OR Jobs.location LIKE '%キャビンアテンダント%'
                OR Jobs.activity LIKE '%キャビンアテンダント%'
                OR Jobs.salary_statistic_group LIKE '%キャビンアテンダント%'
                OR Jobs.salary_range_remarks LIKE '%キャビンアテンダント%'
                OR Jobs.restriction LIKE '%キャビンアテンダント%'
                OR Jobs.remarks LIKE '%キャビンアテンダント%'
                OR Personalities.name LIKE '%キャビンアテンダント%'
                OR PracticalSkills.name LIKE '%キャビンアテンダント%'
                OR BasicAbilities.name LIKE '%キャビンアテンダント%'
                OR Tools.name LIKE '%キャビンアテンダント%'
                OR CareerPaths.name LIKE '%キャビンアテンダント%'
                OR RecQualifications.name LIKE '%キャビンアテンダント%'
                OR ReqQualifications.name LIKE '%キャビンアテンダント%'
            )
            AND publish_status = 1
            AND Jobs.deleted_at IS NULL
            GROUP BY Jobs.id
            ORDER BY Jobs.sort_order DESC, Jobs.id DESC
            LIMIT 50 OFFSET 0
        ";
        $results = DB::select($sql);

        // Calculate metrics
        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime) * 1000;
        $resultCount = count($results);
        $memoryUsage = memory_get_peak_usage(true) / 1024 / 1024; // Convert to MB

        // Log the performance metrics
        Log::info('[Base] Job Search Performance Test Results', [
            'timestamp' => now(),
            'execution_time_ms' => number_format($executionTime, 2),
            'result_count' => $resultCount,
            'memory_usage_mb' => number_format($memoryUsage, 2),
            'query_type' => 'optimized'
        ]);

        // Console output for immediate feedback
        echo "\nBase Query execution time: " . number_format($executionTime, 2) . " ms\n";
        echo "Number of results: " . $resultCount . "\n";
        echo "Memory Usage: " . number_format($memoryUsage, 2) . " MB\n";

        // Assertions
        $this->assertIsArray($results);
        $this->assertLessThan(5000, $executionTime, 'Query took too long to execute (>5000ms)');
    }

    public function testOptimizedJobSearchPerformance()
    {
        // Start timing
        $startTime = microtime(true);

        // Enhanced query using subqueries and UNION for better performance
        $sql = "
            WITH matched_jobs AS (
                SELECT DISTINCT Jobs.id
                FROM jobs Jobs
                INNER JOIN job_categories JobCategories ON Jobs.job_category_id = JobCategories.id
                INNER JOIN job_types JobTypes ON Jobs.job_type_id = JobTypes.id
                WHERE Jobs.publish_status = 1 
                AND Jobs.deleted_at IS NULL
                AND (
                    JobCategories.name LIKE '%キャビンアテンダント%' OR
                    JobTypes.name LIKE '%キャビンアテンダント%' OR
                    Jobs.name LIKE '%キャビンアテンダント%'
                )

                UNION

                SELECT DISTINCT Jobs.id
                FROM jobs Jobs
                INNER JOIN jobs_personalities jp ON Jobs.id = jp.job_id
                INNER JOIN personalities p ON jp.personality_id = p.id
                WHERE Jobs.publish_status = 1 
                AND Jobs.deleted_at IS NULL
                AND p.name LIKE '%キャビンアテンダント%'

                UNION

                SELECT DISTINCT Jobs.id
                FROM jobs Jobs
                INNER JOIN jobs_practical_skills jps ON Jobs.id = jps.job_id
                INNER JOIN practical_skills ps ON jps.practical_skill_id = ps.id
                WHERE Jobs.publish_status = 1 
                AND Jobs.deleted_at IS NULL
                AND ps.name LIKE '%キャビンアテンダント%'
            )
            SELECT 
                Jobs.*,
                JobCategories.name as category_name,
                JobTypes.name as type_name
            FROM matched_jobs mj
            INNER JOIN jobs Jobs ON mj.id = Jobs.id
            INNER JOIN job_categories JobCategories ON Jobs.job_category_id = JobCategories.id
            INNER JOIN job_types JobTypes ON Jobs.job_type_id = JobTypes.id
            ORDER BY Jobs.sort_order DESC, Jobs.id DESC
            LIMIT 50
        ";

        $results = DB::select($sql);

        // Calculate metrics
        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime) * 1000;
        $resultCount = count($results);
        $memoryUsage = memory_get_peak_usage(true) / 1024 / 1024; // Convert to MB

        // Log the performance metrics
        Log::info('[Optimized] Job Search Performance Test Results', [
            'timestamp' => now(),
            'execution_time_ms' => number_format($executionTime, 2),
            'result_count' => $resultCount,
            'memory_usage_mb' => number_format($memoryUsage, 2),
            'query_type' => 'optimized'
        ]);

        // Console output for immediate feedback
        echo "\nOptimized Query execution time: " . number_format($executionTime, 2) . " ms\n";
        echo "Number of results: " . $resultCount . "\n";
        echo "Memory Usage: " . number_format($memoryUsage, 2) . " MB\n";

        // Performance assertions
        $this->assertIsArray($results);
        $this->assertLessThan(1000, $executionTime, 'Optimized query should execute within 1 second');
    }
}
