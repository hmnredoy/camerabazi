<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Job extends Model
{
    protected $guarded=[];

    protected $dates=['expire'];


    public function path()
    {
        return '/jobs/'.$this->id;
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function addCategory($category)
    {
        $this->categories()->save($category);
    }

    public function bidders()
    {
        return $this->hasMany(Bid::class,'job_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function addBid($bid)
    {
        $this->bids()->save($bid);
    }


}
