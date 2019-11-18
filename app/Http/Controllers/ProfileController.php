<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper\HelperController;
use App\Models\Enums\ExperienceTypes;
use App\Models\Enums\SkillToolTypes;
use App\Models\Location;
use App\Models\Profile;
use App\Models\SkillTool;
use App\Models\User;
use App\Repositories\MembershipPurchaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ReflectionClass;

class ProfileController extends Controller
{
    protected $userId;
    protected $membership;

    public function __construct(MembershipPurchaseRepository $membership)
    {
        /*if(Auth::check()){ //Uncomment after integrating Auth
            $this->middleware(function ($request, $next) {
                $this->userId = Auth::id();
                return $next($request);
            });
        }*/
        $this->membership = $membership;

        $this->userId = 1;
    }

    public function edit(User $user)
    {

        $memberBids = $this->membership->getSum($user, 'bids');
        $memberSkills = $this->membership->getSum($user, 'skills');
        $memberCoins = $this->membership->getSum($user, 'coins');
        $amountSpent = $this->membership->getSum($user, 'amount');

        $purchaseHistory = $this->membership->getAllData($user);

        $membershipData = [
            'memberBids' => $memberBids,
            'memberSkills' => $memberSkills,
            'memberCoins' => $memberCoins,
            'amountSpent' => $amountSpent,
            'purchaseHistory' => $purchaseHistory
        ];

        $locations = Location::all();
        $skills = SkillTool::all();
        return view('frontend.profile', compact('locations', 'skills', 'user', 'membershipData'));
    }

    public function update(User $user, Request $request)
    {
        $inputs = $request->all();

        if (Location::where('id', $inputs['location'])->exists()) {
            $location = $inputs['location'];
            $user->locations()->attach($location);
        }
        if (SkillTool::where('id', $inputs['skills'])->exists()) {
            $skills = $inputs['skills'];
            $synced = $user->skillTools()->sync($skills);
            $membershipData = $this->membership->useMembershipData($user, 'skills', count($synced['attached']));
            if($membershipData['LastData'] < 1){
                return back()->with('error', "Insufficient skill points. Please <a href=".route('membership.show').">purchase</a> skills.");
            }
        }

        return success();
    }

    public function show(User $user)
    {

        $profile = Profile::where('user_id', $user->id)->first();
        $profileData = [];
        if ($profile != null) {
            $skills     = HelperController::getDistinctData($profile->skillTools, 'type', SkillToolTypes::skill);
            $tools      = HelperController::getDistinctData($profile->skillTools, 'type', SkillToolTypes::tool);
            $companies  = HelperController::getDistinctData($profile->experiences, 'type', ExperienceTypes::company);
            $educations = HelperController::getDistinctData($profile->experiences, 'type', ExperienceTypes::education);
            $portfolios = $profile->portfolios;

//      $this->makeArray($skills,$tools,$portfolios, $companies,$educations);

            $profileData = [
                'skills'        => $skills,
                'tools'         => $tools,
                'portfolios'    => $portfolios,
                'companies'     => $companies,
                'education'     => $educations
            ];
        }

        dd($profileData);
    }

    /*    public function changePassword(Request $request, User $user){
            $data = $request->all();
            dd($request, $user);
        }*/


}
