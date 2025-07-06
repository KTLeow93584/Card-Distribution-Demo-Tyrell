<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Affiliate extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    const TYPE_TOOL = 1;
    const TYPE_QUALIFICATION = 2;
    const TYPE_CAREER_PATH = 3;

    public function jobsAsTools()
    {
        return $this->belongsToMany(Job::class, 'jobs_tools');
    }

    public function jobsAsCareerPaths()
    {
        return $this->belongsToMany(Job::class, 'jobs_career_paths');
    }

    public function jobsAsRecommendedQualifications()
    {
        return $this->belongsToMany(Job::class, 'jobs_rec_qualifications');
    }

    public function jobsAsRequiredQualifications()
    {
        return $this->belongsToMany(Job::class, 'jobs_req_qualifications');
    }
}