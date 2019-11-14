<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper\HelperController;
use App\Models\Enums\ExperienceTypes;
use App\Models\Enums\SkillToolTypes;
use App\Models\Location;
use App\Models\Profile;
use App\Models\SkillTool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ReflectionClass;

class ProfileController extends Controller
{
    protected $userId;

    public function __construct()
    {
        /*if(Auth::check()){ //Uncomment after integrating Auth
            $this->middleware(function ($request, $next) {
                $this->userId = Auth::id();
                return $next($request);
            });
        }*/

        $this->userId = 1;
    }

    public function edit(){
        $locations = Location::all();
        $skills = SkillTool::all();
        return view('frontend.profile', compact('locations', 'skills'));
    }

    public function update(Request $request){

        $inputs = $request->all();
        if(Location::where('id', $inputs['location'])->exists()){
            $location = $inputs['location'];
        }if(Skill::where('id', $inputs['skill'])->exists()){
            $skills = $inputs['skill'];
        }
        $userProfile = Profile::where('user_id', $this->userId)->first();
        $userProfile->locations()->attach($location);
        $userProfile->skills()->sync($skills);

        dd($request->all());
    }

    public function show(){

        $profile = Profile::where('user_id', $this->userId)->first();

        $skills = HelperController::getDistinctData($profile->skillTools, 'type',SkillToolTypes::skill);
        $tools =  HelperController::getDistinctData($profile->skillTools, 'type',SkillToolTypes::tool);
        $companies = HelperController::getDistinctData($profile->experiences, 'type', ExperienceTypes::company);
        $educations = HelperController::getDistinctData($profile->experiences, 'type', ExperienceTypes::education);
        $portfolios = $profile->portfolios;

//      $this->makeArray($skills,$tools,$portfolios, $companies,$educations);

        $profileData = [
            'skills' => $skills,
            'tools' => $tools,
            'portfolios' => $portfolios,
            'companies' => $companies,
            'education' => $educations
        ];

        dd($profileData);

    }






}
