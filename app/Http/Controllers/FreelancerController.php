<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    public function home()
    {
        return view('freelancer.home');
    }
}
