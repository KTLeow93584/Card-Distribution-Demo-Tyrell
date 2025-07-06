<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class);
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    public function personalities()
    {
        return $this->belongsToMany(Personality::class, 'jobs_personalities');
    }

    public function practicalSkills()
    {
        return $this->belongsToMany(PracticalSkill::class, 'jobs_practical_skills');
    }

    public function basicAbilities()
    {
        return $this->belongsToMany(BasicAbility::class, 'jobs_basic_abilities');
    }

    public function tools()
    {
        return $this->belongsToMany(Affiliate::class, 'jobs_tools')
            ->where('type', 1);
    }

    public function careerPaths()
    {
        return $this->belongsToMany(Affiliate::class, 'jobs_career_paths')
            ->where('type', 3);
    }

    public function recommendedQualifications()
    {
        return $this->belongsToMany(Affiliate::class, 'jobs_rec_qualifications')
            ->where('type', 2);
    }

    public function requiredQualifications()
    {
        return $this->belongsToMany(Affiliate::class, 'jobs_req_qualifications')
            ->where('type', 2);
    }
}