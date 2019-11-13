<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Profile;
use App\Models\Skill;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(){
        $locations = Location::all();
        $skills = Skill::all();
        return view('frontend.profile', compact('locations', 'skills'));
    }

    public function update(Request $request){

        $userID = 1;

        $inputs = $request->all();

        if(Location::where('id', $inputs['location'])->exists()){
            $location = $inputs['location'];
        }if(Skill::where('id', $inputs['skill'])->exists()){
            $skills = $inputs['skill'];
        }

        $userProfile = Profile::where('user_id', $userID)->first();
        $userProfile->locations()->attach($location);
        $userProfile->skills()->sync($skills);


        dd($request->all());
    }
}
