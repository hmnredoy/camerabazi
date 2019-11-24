<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper\CustomHelper;
use App\Http\Controllers\Helper\HelperController;
use App\Models\Enums\ExperienceTypes;
use App\Models\Enums\SkillToolTypes;
use App\Models\Location;
use App\Models\Profile;
use App\Models\Rating;
use App\Models\Review;
use App\Models\SkillTool;
use App\Models\User;
use App\Repositories\MembershipPurchaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use ReflectionClass;

class ProfileController extends Controller
{
    public $user;
    public $membership;

    public function __construct(MembershipPurchaseRepository $membership)
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
        $this->membership = $membership;
    }

    public function edit()
    {
        $user = $this->user;
        $memberBids = $this->membership->getSum($user, 'bids');
        $memberSkills = $this->membership->getSum($user, 'skills');
        $memberCoins = $this->membership->getSum($user, 'coins');
        $amountSpent = $this->membership->getSum($user, 'amount', 1, false);

        $reviews = $user->reviews()->get();
        $rating = $user->ratings()->avg('rating');

        $purchaseHistory = $this->membership->getAllData($user);

        $membershipData = [
            'rating' => number_format($rating, 2),
            'memberBids' => $memberBids,
            'memberSkills' => $memberSkills,
            'memberCoins' => $memberCoins,
            'amountSpent' => $amountSpent,
            'purchaseHistory' => $purchaseHistory
        ];


        $locations = Location::all();
        $skills = SkillTool::all();
        return view('frontend.profile', compact('locations', 'skills', 'user', 'membershipData', 'reviews'));
    }

    public function update(Request $request)
    {
        $inputs = $request->all();

        $data = [
            'gender' => $inputs['gender'],
        ];

        if (@Location::where('id', $inputs['location'])->exists()) {
            $location = $inputs['location'];
            $this->user->locations()->sync($location);
        }
        if (@SkillTool::where('id', $inputs['skills'])->exists()) {
            $skills = $inputs['skills'];
            $synced = $this->user->skillTools()->sync($skills);
            $membershipData = $this->membership->useMembershipData($this->user, 'skills', count($synced['attached']));
            if($membershipData['LastData'] < 1){
                return back()->with('error', "Insufficient skill points. Please <a href=".route('membership.show').">purchase</a> skills.");
            }
        }

        if(isset($inputs['profile_image'])){
            $image = CustomHelper::store($request->file('profile_image'));
            $data = array_merge($data, ['profile_image' => $image->name]);
        }if(isset($inputs['cover_image'])){
            $image = CustomHelper::store($request->file('cover_image'));
            $data = array_merge($data, ['cover_image' => $image->name]);
        }


        $request->user()->profile()->update($data);

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


    public function showchangePassword()
    {
        return view('freelancer.change-password');
    }
    public function changePassword(Request $request)
    {

        $user = auth()->user();

        $request->validate([
                'old_password' => 'required',
                'password' => 'required|min:6|confirmed',
            ]
        );

        $data = $request->all();


        if (!Hash::check($data['old_password'], $user->password)) {
            return back()->with('error', 'The specified password does not match the database password');
        } else {
            // write code to update password

            $user->update([
                'password' => $request->password,
            ]);
            return redirect('profile/change-password');
        }
    }





}
