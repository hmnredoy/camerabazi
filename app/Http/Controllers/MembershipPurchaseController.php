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
    protected $membership;

    public function __construct(MembershipPurchaseRepository $membership)
    {
        $this->membership = $membership;
    }
    public function buyMembership(User $user, MembershipPlan $membershipPlan){
        $membershipData = $this->membership->getMembershipData($user);
      //  dd($user, $membershipData,  $membershipPlan);
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
