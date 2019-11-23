<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = ['job_id', 'freelancer_id', 'amount', 'delivery_days', 'description'];

    public function attachments()
    {
        return $this->morphMany('App\Models\Attachment', 'attachmentable');
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeProposedBid($query)
    {
        return $query->where('freelancer_id',auth()->id());   
    }


}
