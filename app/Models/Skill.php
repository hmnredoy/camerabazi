<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TunnelConflux\DevCrud\Models\DevCrudModel;

class Skill extends DevCrudModel
{
    protected $table = 'skills';

    protected $fillable = ['skill'];
}
