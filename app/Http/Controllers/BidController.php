<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Bid;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BidController extends Controller
{
    public function show(Job $job) {

        return view('frontend.freelancer.bid',['job'=>$job]);
    }
    public function store(Request $request, Job $job) {


        $request->validate([
            'amount' => 'required',
            'delivery_days' => 'required',

        ]);
        $input = $request->all();

        $bid = new Bid($input);
        $bid->freelancer_id = auth()->id();

        $job->bids()->save($bid);



//        $bid = Bid::create([
//            'amount' => $input['amount'],
//            'delivery_days' => $input['days'],
//            'description' => $input['description'],
////            'job_id' => $job->id,
//            'job_id' => $job_id,
////            'freelancer_id' => Auth::id(),
//            'freelancer_id' => 1,
//        ]);
//
//        if(!$bid || $bid == null){
//            return back()->with('error', 'Bid could not be created!');
//        }

        if(isset($input['files'])) {
            foreach ($input['files'] as $file) {
                addAttachment($bid, $file);
            }
        }

        return back()->with('success', 'Bid created successfully!');
    }

    public function all($id){
        $bid = Bid::find($id);

        /*foreach ($bid->attachments as $attachment){
            dd($attachment);
        }*/

        dd($bid->attachments);
    }

    public function delete($id){
        $bid = Bid::find($id);

        deleteWithAttachments($bid);
    }

}
