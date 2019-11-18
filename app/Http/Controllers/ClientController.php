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

    public function jobBid(Job $job)
    {
        $bids = $job->bids;

/*        $subset = $bids->map(function ($bid) {
            return collect($bid)
                ->all();
        });*/

       // dd($bids);

        foreach ($bids as $bid){
            dd($bid, $bid->attachments, $bid->freelancer, $bid->freelancer->rating);
        }
    }



    public function home()
    {
        return view('client.home');
    }
}
