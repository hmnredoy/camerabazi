<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function store(Request $request){

        $portfolio = new Portfolio();
        $request->request->add(['user_id' => auth()->id()]);
        validateRequest($portfolio, $request, ['image' => 'mimes:jpeg,png']);
        $input = $request->all();

        $portfolio->fill($input);

        if(isset($input['image'])) {
           $imageData = store($input['image']);
           $portfolio->image = $imageData->name;
        }
        $portfolio->save();

        if($portfolio){
            return success();
        }
        return error('Action could not be performed!');
    }
}
