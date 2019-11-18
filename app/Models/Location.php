<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TunnelConflux\DevCrud\Models\DevCrudModel;

class Location extends DevCrudModel
{
    protected $fillable = ['title', 'status'];
}
