<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['posted_by', 'posted_on', 'job_id', 'commenter_job', 'comment'];

    public function rating(){
        return $this->hasOne(Rating::class);
    }

    public function job(){
        return $this->belongsTo(Job::class);
    }

    public function postedBy(){
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function postedOn(){
        return $this->belongsTo(User::class, 'posted_on');
    }
}
