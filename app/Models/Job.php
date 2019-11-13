<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded=[];


    public function path()
    {
        return '/jobs/'.$this->id;
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
