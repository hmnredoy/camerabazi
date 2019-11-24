<?php

namespace App\Http\Controllers\Backend;

use App\Models\Backend\Job;
use App\Models\Enums\JobStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TunnelConflux\DevCrud\Controllers\DevCrudController;
use TunnelConflux\DevCrud\Models\DevCrudModel;

class JobController extends DevCrudController
{
    public function __construct(Job $model)
    {
        parent::__construct($model);
    }


}
