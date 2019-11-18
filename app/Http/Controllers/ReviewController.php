<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function show(Job $job){
        return view('frontend.client.review', ['job' => $job]);
    }

    public function store(Request $request, Job $job){
        $model = new Review;
        $request->request->add(
            [
                'posted_by' => Auth::id(),//dummy
                'posted_on' => $job->client->id,
                'project_id' => $job->id
            ]
        );

        $data = $request->all();
        validateRequest(
            $model, $request,
            ['project_id' => 'unique:reviews'],
            ['project_id.unique' => 'You have already submitted a review.']
        );

        Review::create($data);

        return back()->with('success', 'Comment posted!');
    }

    public function update(Request $request){
        $model = new Review;
        $request->request->add(
            [
                'posted_by' => Auth::id() ?? 1,//dummy
                'posted_on' => 1,//dummy
                'project_id' => 1//dummy
            ]
        );

        $data = $request->all();
        validateRequest($model, $request);
        Review::update($data);

        return back()->with('success', 'Comment posted!');
    }
}
