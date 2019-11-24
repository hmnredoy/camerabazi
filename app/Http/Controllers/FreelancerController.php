<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    public function home()
    {
        $jobs = Job::active()->get();

        return view('freelancer.home',['jobs'=>$jobs]);
    }

    public function proposedJobs()
    {
        $proposededJobs = Job::freelancerProposedJobs()->latest()->get();

        return view('client.myjobs',['jobs'=>$proposededJobs]);
    }
    public function submittedBidsJobs()
    {
        $submittedBids = auth()->user()->getSubmittedBids();

        return  view('freelancer.submitted-jobs',['bids'=> $submittedBids]);
    }

    public function activeBids() // job not expired yet
    {
        $activeBids = auth()->user()->getActivedBids();
        return  view('freelancer.active-jobs',['bids'=> $activeBids]);
    }

    public function ongoingBids()
    {
        $ongoingeBids = auth()->user()->getOngoingBids();
        return  view('freelancer.ongoing-jobs',['bids'=> $ongoingeBids]);
    }

    public function getJobs($request)
    {
        $jobs = null;

        if($request->has('location')){
            $locationId = $request->get('location');
            $jobs = \DB::table('jobs')->where('location_id','=',$locationId);
        }
        return $jobs->get();

    }


}
