<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = ['slug', 'job_id', 'freelancer_id','job_freelancer', 'amount', 'delivery_days', 'description'];

    public function attachments()
    {
        return $this->morphMany('App\Models\Attachment', 'attachmentable');
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
    public function freelancer(){
        return $this->hasOne(User::class, 'id', 'freelancer_id');
    }

}
