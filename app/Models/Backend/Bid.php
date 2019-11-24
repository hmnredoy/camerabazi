<?php

namespace App\Models\Backend;

use App\Models\Enums\BidStatus;
use App\Models\Job;
use App\Models\User;
use TunnelConflux\DevCrud\Models\DevCrudModel;

class Bid extends DevCrudModel
{
    protected $table            = 'bids';
    protected $fillable         = ['job_id', 'freelancer_id', 'amount', 'delivery_days', 'description', 'status'];
    protected $listColumns      = ['job', 'freelancer', 'amount', 'delivery_days', 'bid_status', 'created_at'];
    protected $requiredItems    = ['amount', 'delivery_days', 'description', 'status'];
    protected $infoItems        = ['job', 'freelancer', 'amount', 'delivery_days', 'description', 'status', 'created_at', 'updated_at'];

    public function getJobAttribute(){
        return "<a href=".route('job.view', $this->job()->first()->id).">".$this->job()->first()->title."</a>" ?? 'N\A';
    }
    public function getFreelancerAttribute(){
        return "<a href=".route('user.view', $this->freelancer()->first()->id).">".$this->freelancer()->first()->name."</a>" ?? 'N\A';

    }

    public function getBidStatusAttribute(){
        return $this->attributes['status'] ? BidStatus::getKey($this->attributes['status']) : 'N\A';
    }

    public function getFormAble()
    {
        $form = parent::getFormAble();

        $form['status'] ? $form['status']->setOptions(BidStatus::unsetKeys(BidStatus::getHumanKeys(), []))->setType('select') : null;
        return $form;
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }
    public function freelancer(){
        return $this->belongsTo(User::class, 'freelancer_id', 'id');
    }

}
