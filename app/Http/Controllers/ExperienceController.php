<?php

namespace App\Http\Controllers;

use App\Models\Enums\ExperienceTypes;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TunnelConflux\DevCrud\Requests\SaveFormRequest;

class ExperienceController extends Controller
{
    public function store(Request $request){
        $model = new Experience;

//        $data['user_id'] = Auth::id() ?? 1;
        $request->request->add(['user_id' => Auth::id() ?? 1]);
        $data = $request->all();

        if($data['type'] == ExperienceTypes::education){
            $ignore = [
              'description'
            ];
            validateRequest($model, $request, null, null, $ignore);//use validateRequest($model, $request) if only fillables are required
        }

        if($data['type'] == ExperienceTypes::company) {
            validateRequest($model, $request);
        }

        Experience::create($data);

        return back()->with('success', 'Success!');
    }
}
