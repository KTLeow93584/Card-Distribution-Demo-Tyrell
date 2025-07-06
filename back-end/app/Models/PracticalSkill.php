<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PracticalSkill extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'jobs_practical_skills');
    }
}