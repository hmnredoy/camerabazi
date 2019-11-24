<?php

namespace App\Models;

use App\Models\Enums\JobStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use TunnelConflux\DevCrud\Helpers\DevCrudHelper;
use TunnelConflux\DevCrud\Models\DevCrudModel;

class Job extends Model
{
    protected $guarded=[];

    protected $dates=['expire'];

    protected $withCount=['bids'];

    public function scopeActive(){
        return $this->where('status', JobStatus::Active);
    }

    public function path()
    {
        return '/jobs/'.$this->slug;
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

    public function scopeClientSubmittedJobs($query)
    {

        return  $query->where('user_id',auth()->id());

    }

    public function scopeClientCanceledJobs($query)
    {

        return  $query->where('user_id',auth()->id())
                        ->where('status',JobStatus::cancelled);

    }

    public function scopeFreelancerProposedJobs($query)
    {

        $proposalsQuery = Bid::proposedBid();
        return  $proposalsQuery->where('job_id',$this->id);


    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] =  DevCrudHelper::makeSlug($this, $value);
    }

}
