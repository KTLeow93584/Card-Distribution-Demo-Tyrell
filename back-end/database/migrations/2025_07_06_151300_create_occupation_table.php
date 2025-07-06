<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Drop tables in reverse order to avoid foreign key constraints
        Schema::dropIfExists('jobs_req_qualifications');
        Schema::dropIfExists('jobs_rec_qualifications');
        Schema::dropIfExists('jobs_career_paths');
        Schema::dropIfExists('jobs_tools');
        Schema::dropIfExists('jobs_basic_abilities');
        Schema::dropIfExists('jobs_practical_skills');
        Schema::dropIfExists('jobs_personalities');
        Schema::dropIfExists('affiliates');
        Schema::dropIfExists('basic_abilities');
        Schema::dropIfExists('practical_skills');
        Schema::dropIfExists('personalities');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_types');
        Schema::dropIfExists('job_categories');
        
        // Job Categories Table
        Schema::create('job_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('sort_order');
            $table->integer('created_by');
            $table->timestamps();
            $table->softDeletes();
        });

        // Job Types Table
        Schema::create('job_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('job_category_id')->constrained();
            $table->integer('sort_order');
            $table->integer('created_by');
            $table->timestamps();
            $table->softDeletes();
        });

        // Jobs Table
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('media_id')->nullable();
            $table->foreignId('job_category_id')->constrained();
            $table->foreignId('job_type_id')->constrained();
            $table->text('description');
            $table->text('detail');
            $table->text('business_skill');
            $table->text('knowledge');
            $table->string('location');
            $table->text('activity');
            $table->boolean('academic_degree_doctor')->default(false);
            $table->boolean('academic_degree_master')->default(false);
            $table->boolean('academic_degree_professional')->default(false);
            $table->boolean('academic_degree_bachelor')->default(false);
            $table->string('salary_statistic_group');
            $table->string('salary_range_first_year');
            $table->string('salary_range_average');
            $table->text('salary_range_remarks');
            $table->text('restriction');
            $table->integer('estimated_total_workers');
            $table->text('remarks');
            $table->string('url');
            $table->text('seo_description');
            $table->text('seo_keywords');
            $table->integer('sort_order');
            $table->tinyInteger('publish_status');
            $table->integer('version');
            $table->integer('created_by');
            $table->timestamps();
            $table->softDeletes();
        });

        // Personalities Table
        Schema::create('personalities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        // Practical Skills Table
        Schema::create('practical_skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        // Basic Abilities Table
        Schema::create('basic_abilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        // Affiliates Table (for Tools, Career Paths, and Qualifications)
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('type'); // 1:Tools, 2:Qualifications, 3:Career Paths
            $table->timestamps();
            $table->softDeletes();
        });

        // Pivot Tables
        Schema::create('jobs_personalities', function (Blueprint $table) {
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->foreignId('personality_id')->constrained()->onDelete('cascade');
            $table->primary(['job_id', 'personality_id']);
        });

        Schema::create('jobs_practical_skills', function (Blueprint $table) {
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->foreignId('practical_skill_id')->constrained()->onDelete('cascade');
            $table->primary(['job_id', 'practical_skill_id']);
        });

        Schema::create('jobs_basic_abilities', function (Blueprint $table) {
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->foreignId('basic_ability_id')->constrained()->onDelete('cascade');
            $table->primary(['job_id', 'basic_ability_id']);
        });

        Schema::create('jobs_tools', function (Blueprint $table) {
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->foreignId('affiliate_id')->constrained()->onDelete('cascade');
            $table->primary(['job_id', 'affiliate_id']);
        });

        Schema::create('jobs_career_paths', function (Blueprint $table) {
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->foreignId('affiliate_id')->constrained()->onDelete('cascade');
            $table->primary(['job_id', 'affiliate_id']);
        });

        Schema::create('jobs_rec_qualifications', function (Blueprint $table) {
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->foreignId('affiliate_id')->constrained()->onDelete('cascade');
            $table->primary(['job_id', 'affiliate_id']);
        });

        Schema::create('jobs_req_qualifications', function (Blueprint $table) {
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->foreignId('affiliate_id')->constrained()->onDelete('cascade');
            $table->primary(['job_id', 'affiliate_id']);
        });
    }

    public function down()
    {
        // Drop tables in reverse order to avoid foreign key constraints
        Schema::dropIfExists('jobs_req_qualifications');
        Schema::dropIfExists('jobs_rec_qualifications');
        Schema::dropIfExists('jobs_career_paths');
        Schema::dropIfExists('jobs_tools');
        Schema::dropIfExists('jobs_basic_abilities');
        Schema::dropIfExists('jobs_practical_skills');
        Schema::dropIfExists('jobs_personalities');
        Schema::dropIfExists('affiliates');
        Schema::dropIfExists('basic_abilities');
        Schema::dropIfExists('practical_skills');
        Schema::dropIfExists('personalities');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_types');
        Schema::dropIfExists('job_categories');
    }
};