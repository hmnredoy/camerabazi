<?php

namespace App\Http\Controllers\Helper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ReflectionClass;

class HelperController extends Controller
{
    public static function getDistinctData($skillTool, $column, $type){
        $filtered_collection = $skillTool->filter(function ($item) use ($column, $type) {
            if($item->$column == $type) {
                return $item;
            }
        })->values();
        return $filtered_collection;
    }

    public static function makeArray(...$args){
        $arr = [];
        foreach ($args as $arg){
            $function = new ReflectionClass($arg[0]);
            $arr[strtolower($function->getShortName())] = $arg;
        }
        return $arr;
    }

}
