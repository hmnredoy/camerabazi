<?php

namespace App\Http\Controllers;

use App\Models\Enums\ExperienceTypes;
use App\Models\Experience;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TunnelConflux\DevCrud\Requests\SaveFormRequest;

class ExperienceController extends Controller
{
    public function store(Request $request){
        $experience = new Experience;
        $user = auth()->user();
        $request->request->add(['user_id' => Auth::id() ?? $user->id]);
        $data = $request->all();
        $ignore = ['currently_working', 'description'];
        $exclude = [];

        if(isset($data['currently_working'])){
            $data['currently_working'] = true;
            array_push($ignore, 'ended_at');
            $exclude = ['ended_at'];
        }
        else{
            if($data['started_at'] > $data['ended_at']){
                return error('Starting date cannot be older than ending date.');
            }
        }
        if($data['type'] == ExperienceTypes::education){
            validateRequest($experience, $request, null,
                [
                    'ended_at.not_in' => 'Ended at is invalid if you currently study here.',
                    'title_or_country.required' => 'Country is required.',
                ]
                , $ignore, $exclude);//use validateRequest($model, $request) if only fillables are required
        }
        if($data['type'] == ExperienceTypes::company) {
            validateRequest($experience, $request,null,
                [
                    'ended_at.not_in' => 'Ended at is invalid if you currently work here.',
                    'title_or_country.required' => 'Title is required.',
                    'institute.required' => 'Company field is required.'
                ], $ignore, $exclude);
        }

        $res = $experience->create($data);

        if($res){
            return success();
        }
        return error();
    }
}
