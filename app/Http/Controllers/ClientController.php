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

    public function submittedJobs()
    {
        //$jobs = auth()->user()->jobs;
        $submittedJobs = Job::clientSubmittedJobs()->latest()->get();
        return view('client.myjobs',['jobs'=>$submittedJobs]);
    }

    public function canceledJobs()
    {
        $canceledJobs = Job::clientCanceledJobs()->latest()->get();
        return view('client.myjobs',['jobs'=>$canceledJobs]);   
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
