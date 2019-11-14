<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    public function home()
    {
        $jobs = Job::all();
        return view('freelancer.home',['jobs'=>$jobs]);
    }
}
