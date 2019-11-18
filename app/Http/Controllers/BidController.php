<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Bid;
use App\Models\MembershipPurchase;
use App\Models\Job;
use App\Repositories\MembershipPurchaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $request->request->add(['freelancer_id' => $freelancerId, 'job_id' => $job->id]);

        validateRequest($bid, $request,
            ['job_id' => 'unique:bids'],
            ['job_id.unique' => 'You have already submitted a bid.']
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
