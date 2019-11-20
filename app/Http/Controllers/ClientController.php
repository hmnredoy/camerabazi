<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');


    }

    public function myJobs()
    {
        $jobs = auth()->user()->jobs;
        return view('client.myjobs',['jobs'=>$jobs]);
    }

    public function jobProposal(Job $job)
    {
        $proposal = $job->bids;
        dd($proposal);
    }

    public function ongoingJobs()
    {
        $jobs = auth()->user()->getOngoingJobs();
        return view('client.ongoing-jobs',['jobs'=>$jobs]);
    }



    public function home()
    {
        return view('client.home');
    }
}
