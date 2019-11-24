<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\Location;
use App\Models\Enums\JobStatus;
use Illuminate\Http\Request;
use TunnelConflux\DevCrud\Helpers\DevCrudHelper;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('jobs.create',['categories'=> $categories,'locations'=> $locations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'expire' => ['required', 'date'],
            'budget' => ['required','numeric'],
            'description' => '',
            'location_id'=> 'required',
        ]);

        $job = new Job();

        $data['user_id'] = auth()->id();

        $job = $job->create($data);

        $categories = $request->get('categories');

        $job->categories()->attach($categories);

        return redirect($job->path());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        return view('jobs.show',['job'=>$job]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }

    public function search(Request $request)
    {


        $jobs = $this->getJobs($request);
        return view('jobs.search',['jobs'=>$jobs]);
    }

    public function getJobs($request)
    {

        $query = Job::limit(10);

        if($request->has('location')){
            $location= $request->get('location');
            $query->where('location_id','=',$location);
        }

        dd($query->get());

        return $query->get();

    }

    public function cancel(Job $job)
    {
        $job->status = JobStatus::Cancelled;
        $job->save();
    }

}
