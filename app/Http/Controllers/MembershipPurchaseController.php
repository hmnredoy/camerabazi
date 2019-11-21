<?php

namespace App\Http\Controllers;

use App\Models\MembershipPurchase;
use App\Models\MembershipPlan;
use App\Models\User;
use App\Repositories\MembershipPurchaseRepository;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;

class MembershipPurchaseController extends Controller
{
    private $membership;

    public function __construct(MembershipPurchaseRepository $membership)
    {
        $this->membership = $membership;
    }
    public function buyMembership(MembershipPlan $membershipPlan){
        $user = auth()->user();
       // $membershipData = $this->membership->getMembershipData($user);
        $accountInfo = $user->accountInfo;
        $currentBalance = $accountInfo->current_balance ?? 0;

        if($currentBalance < $membershipPlan->amount){
            return back()->with('error', 'Low balance! Please recharge.');
        }
        $current_balance = $currentBalance - $membershipPlan->amount;
        $last_balance = $currentBalance;
        $user->account()->update(compact('current_balance', 'last_balance'));

        if($membershipPlan){
            $updatedPlan = [
                "freelancer_id" => $user->id,
                "membership_id" => $membershipPlan->id,
                "amount" => $membershipPlan->amount,
                "bids" => $membershipPlan->bids,
                "skills" => $membershipPlan->skills,
                "coins" => $membershipPlan->coins,
                "expire" => $membershipPlan->expire_days ? CarbonImmutable::now()->add($membershipPlan->expire_days, 'day')->format('Y-m-d H:i:s') : null
            ];
            $user->membership()->create($updatedPlan);
        }

        return success();

    }

}
