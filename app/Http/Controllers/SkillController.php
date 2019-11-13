<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use TunnelConflux\DevCrud\Controllers\DevCrudController;

class SkillController extends DevCrudController
{
    public function __construct(Skill $model)
    {
        parent::__construct($model);
    }
}
