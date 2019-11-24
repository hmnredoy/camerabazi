<?php

namespace App\Http\Controllers\Backend;

use App\Models\Backend\Bid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TunnelConflux\DevCrud\Controllers\DevCrudController;
use TunnelConflux\DevCrud\Models\DevCrudModel;

class BidController extends DevCrudController
{
    public function __construct(Bid $model)
    {
        parent::__construct($model);
        $this->isCreatable = false;
    }
}
