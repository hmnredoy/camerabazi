<?php

namespace App\Models;

use App\Models\Enums\JobStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Job extends Model
{
    protected $guarded=[];

    protected $dates=['expire'];

    protected $withCount=['bids'];


    public function path()
    {
        return '/jobs/'.$this->id;
    }

    public function client()
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


    public function attachments()
    {
        return $this->morphMany('App\Models\Attachment', 'attachmentable');
    }



    public function addBid($bid)
    {
        $this->bids()->save($bid);
    }

    public function markAccepted(Bid $bid)
    {
      $bid->is_accepted = true;
      $bid->save();

    }

    public function markCanceled(Bid $bid)
    {
        $bid->is_accepted = false;
        $bid->save();

    }



    public function  markSucceeded(Bid $bid)
    {
        $bid->is_accepted = false;
        $bid->save();
    }

    public function getAcceptedBid()
    {
        $this->refresh();

        $bidsCollection = $this->bids->filter(function ($bid){
            return $bid->is_accepted;
        });


        return $bidsCollection->first();
    }

    public function getAvgBid()
    {
        return $this->bids->avg('amount');




    }


}
