<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TunnelConflux\DevCrud\Models\DevCrudModel;

class SkillTool extends DevCrudModel
{
    protected $fillable = ['title','type','status'];
}
