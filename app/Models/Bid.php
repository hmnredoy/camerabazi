<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use TunnelConflux\DevCrud\Helpers\DevCrudHelper;

class Bid extends Model
{
    protected $fillable = ['job_id', 'freelancer_id','job_freelancer', 'amount', 'delivery_days', 'description', 'status'];

    public function attachments()
    {
        return $this->morphMany('App\Models\Attachment', 'attachmentable');
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

	public function freelancer(){
        return $this->belongsTo(User::class, 'freelancer_id', 'id');
    }


    public function scopeProposedBid($query)
    {
        return $query->where('freelancer_id',auth()->id());
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug =  'bid-of-'.DevCrudHelper::makeSlug($model, Job::find($model->job_id)->title);

            validateRequest(['job_freelancer'], ['job_freelancer' => $model->job_id.'-'.$model->freelancer_id],
                ['job_freelancer' => 'unique:bids'],
                ['job_freelancer.unique' => 'You have already submitted a bid.'],['slug']
            );

            $model->job_freelancer = $model->job_id.'-'.$model->freelancer_id;
        });
    }

}
