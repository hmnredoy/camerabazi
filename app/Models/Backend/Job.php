<?php

namespace App\Models\Backend;

use App\Models\Bid;
use App\Models\Enums\JobStatus;
use Illuminate\Database\Eloquent\Model;
use TunnelConflux\DevCrud\Helpers\DevCrudHelper;
use TunnelConflux\DevCrud\Models\DevCrudModel;

class Job extends DevCrudModel
{
    protected $table = 'jobs';

    protected $fillable = ['title', 'expire', 'budget', 'status'];
    protected $listColumns = ['title', 'expire', 'budget', 'bids', 'job_status', 'created_at'];

    protected $requiredItems = ['title', 'expire', 'budget', 'status'];

    public function getBidsAttribute(){
        return $this->bids()->count() ?? '0';
    }

    public function getJobStatusAttribute(){
        return $this->attributes['status'] ? JobStatus::getKey($this->attributes['status']) : 'N\A';
    }

    public function getFormAble()
    {
        $form = parent::getFormAble();
        $form['status'] ? $form['status']->setOptions(JobStatus::unsetKeys(JobStatus::getHumanKeys(), [JobStatus::Submitted]))->setType('select') : null;
        return $form;
    }

    public function bids()
    {
        return $this->hasMany(Bid::class, 'job_id', 'id');
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] =  DevCrudHelper::makeSlug($this, $value);
    }
}
