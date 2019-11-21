<?php

namespace App\Http\Controllers;

use App\Models\ClientOffer;
use App\Models\Enums\OfferStatus;
use App\Repositories\CommonRepository;
use App\Repositories\MembershipPurchaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TunnelConflux\DevCrud\Controllers\DevCrudController;

class DashboardController extends Controller
{
    private $membership;
    private $common;
    private $user;

    public function __construct(MembershipPurchaseRepository $membership, CommonRepository $common)
    {
        $this->membership = $membership;
        $this->common = $common;
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        return view('backend.dashboard');
    }

    public function freelancer(){
        $remainingBid   = $this->membership->getSum($this->user, 'bids');
        $clientOffer    = new ClientOffer;
        $activeOffers   = $this->common->getWithStatus($clientOffer,OfferStatus::Active,'freelancer_id', $this->user->id);
        $acceptedOffers = $this->common->getWithStatus($clientOffer,OfferStatus::Accepted,'freelancer_id', $this->user->id);
        $nonExpiredMembershipData = $this->membership->getAllData($this->user, '*', true);
        $totalActiveOffers = $activeOffers->count();
        $totalAcceptedOffers = $acceptedOffers->count();
        $currentBalance = $this->user->accountInfo->current_balance;

        dd($remainingBid, $activeOffers, $nonExpiredMembershipData);
    }

    public function client(){

    }
}
