<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\ClientOffer;
use App\Models\Enums\BidStatus;
use Illuminate\Http\Request;

class ClientOfferController extends Controller
{
    public function index(Bid $bid) {
        return view('frontend.client.offer', compact('bid'));
    }

    public function store(Request $request, Bid $bid) {

        $request->request->add(['freelancer_id' => $bid->freelancer_id, 'client_id' => auth()->id(), 'bid_id' => $bid->id]);
        $inputs = $request->all();
        $offer = ClientOffer::create($inputs);

        $bid = $offer->bid()->first();
        $bid->status = BidStatus::Offered;
        $bid->save();

        return success();
    }
}
