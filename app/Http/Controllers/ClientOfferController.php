<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper\CustomHelper;
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
        $offer = new ClientOffer();

        $request->request->add(
            [
                'freelancer_id' => $bid->freelancer_id,
                'client_id' => auth()->id(),
                'bid_id' => $bid->id,
                'client_freelancer_bid' => auth()->id().'-'.$bid->freelancer_id.'-'.$bid->id
            ]);

        $inputs = $request->all();

        CustomHelper::validateRequest($offer, $request,
            ['client_freelancer_bid' => 'unique:client_offers'],
            ['client_freelancer_bid.unique' => 'Offer already sent to this freelancer.']
        );

        $offer->create($inputs);

        $bid->status = BidStatus::Offered;
        $bid->save();

        return CustomHelper::success();
    }


/*    public function getTableColumns($table)
    {
        return DB::getSchemaBuilder()->getColumnListing($table);
    }*/
}
