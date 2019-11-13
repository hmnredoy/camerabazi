<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

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

    public function bids(){
        return $this->hasMany(Bid::class);
    }


    /*protected static function boot()
    {
        parent::boot();
        static::deleting(function (self $item) {
            if (Schema::hasColumn($item->getTable(), 'job_id')) {

            }
        });
    }*/
}
