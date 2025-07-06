<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobCategory extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function jobTypes()
    {
        return $this->hasMany(JobType::class);
    }
}