<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function show(){
        return view('frontend.client.review');
    }

    public function store(Request $request){
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
