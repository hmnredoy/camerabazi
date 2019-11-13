<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use TunnelConflux\DevCrud\Controllers\DevCrudController;

class LocationController extends DevCrudController
{
    public function __construct(Location $model)
    {
        parent::__construct($model);
    }
}
