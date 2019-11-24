<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Enums\JobStatus;
use App\Models\Job;
use App\Repositories\MembershipPurchaseRepository;
use Illuminate\Http\Request;

class BidController extends Controller
{
    protected $membership;

    public function __construct(MembershipPurchaseRepository $membership)
    {
        $this->membership = $membership;
    }

    public function show(Job $job) {
        return view('frontend.freelancer.bid',['job'=>$job]);
    }

    public function store(Request $request, Job $job) {

        $bid = new Bid();
        $freelancerId = auth()->id();

        $request->request->add([
            'freelancer_id' => $freelancerId,
            'job_id' => $job->id,
        ]);

        validateRequest($bid, $request,
            ['job_freelancer' => 'unique:bids'],
            ['job_freelancer.unique' => 'You have already submitted a bid.'],['status', 'slug']
        );

        $membershipData = $this->membership->useMembershipData($freelancerId, 'bids',1);

        if($membershipData['LastData'] < 1){
            return back()->with('error', "You don't have enough bids. Please <a href=".route('membership.show').">purchase</a> bids.");
        }
        $input = $request->all();

        $bid = $bid->create($input);

        if(isset($input['files'])) {
            foreach ($input['files'] as $file) {
                addAttachment($bid, $file);
            }
        }

        return $bid ? success() : error();
    }

    public function all($id){
        $bids = Job::find($id)->bids()->get();

        /*foreach ($bid->attachments as $attachment){
            dd($attachment);
        }*/

        dd($bids);
    }

    public function delete($id){
        $bid = Bid::find($id);

        deleteWithAttachments($bid);
    }

    public function approved(Job $job,Bid $bid)
    {

        $job->markAccepted($bid);
        $job->status = JobStatus::ongoing;
        $job->save();
        return back();
    }


    public function cancel(Job $job,Bid $bid)
    {
        $job->markCanceled($bid);
        $job->status = JobStatus::cancelled;
        $job->save();
        return back();
    }

    public function succeeded(Job $job,Bid $bid)
    {

        $job->status = JobStatus::succeeded;
        $job->save();
        return back();
    }





}
