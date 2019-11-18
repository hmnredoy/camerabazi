<?php

namespace App\Http\Controllers;

use App\Models\MembershipPlan;
use Illuminate\Http\Request;
use TunnelConflux\DevCrud\Controllers\DevCrudController;

class MembershipPlanController extends DevCrudController
{
    public function __construct(MembershipPlan $model)
    {
        parent::__construct($model);
    }

    public function showPlans(){
        $memberships = MembershipPlan::orderBy('order_index', 'asc')->get();

        return view('frontend.freelancer.membership.show', compact('memberships'));
    }
}
