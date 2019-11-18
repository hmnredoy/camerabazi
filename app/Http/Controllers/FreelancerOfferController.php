<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\ClientOffer;
use App\Models\Enums\BidStatus;
use Illuminate\Http\Request;

class FreelancerOfferController extends Controller
{
    public function index(Bid $bid){
        $offer = ClientOffer::where('bid_id', $bid->id)->first();
        return view('frontend.freelancer.offer', compact('bid', 'offer'));
    }

    public function update(Request $request, Bid $bid){
        $status = array_intersect([$request->decision], BidStatus::data());
        if(!empty($status)){
            $bid->status = $status;
            $bid->save();
            return success();
        }
        return error();
    }
}
