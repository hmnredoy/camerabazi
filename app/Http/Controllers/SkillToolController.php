<?php

namespace App\Http\Controllers;

use App\Models\SkillTool;
use Illuminate\Http\Request;
use TunnelConflux\DevCrud\Controllers\DevCrudController;
use TunnelConflux\DevCrud\Models\DevCrudModel;

class SkillToolController extends DevCrudController
{
    public function __construct(SkillTool $model)
    {
        parent::__construct($model);
    }
}
