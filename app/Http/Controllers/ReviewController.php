<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TunnelConflux\DevCrud\Helpers\DevCrudHelper;

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
                'job_id' => $job->id,
                'commenter_job' => Auth::id().'-'.$job->id
            ]
        );

        $data = $request->all();

        validateRequest(
            $model, $request,
            ['commenter_job' => 'unique:reviews'],
            ['commenter_job.unique' => 'You have already submitted a review.']
        );

        $review = Review::create($data);

        if($review){
            Rating::insert(
                [   'user_id' => $job->client->id,
                    'review_id' => $review->id,
                    'rating' => $data['rating']
                ]);

            return back()->with('success', 'Review posted!');
        }

        return error();
    }

    public function update(Request $request, Job $job){
        $model = new Review;
        $request->request->add(
            [
                'posted_by' => Auth::id() ?? 1,//dummy
                'posted_on' => 1,//dummy
                'job_id' => 1//dummy
            ]
        );

        $data = $request->all();
        validateRequest($model, $request);
        Review::update($data);

        return back()->with('success', 'Comment posted!');
    }
}
