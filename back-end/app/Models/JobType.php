<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobType extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}