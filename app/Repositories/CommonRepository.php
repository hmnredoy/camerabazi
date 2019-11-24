<?php


namespace App\Repositories;

use App\Http\Controllers\Helper\CustomHelper;
use Illuminate\Database\Eloquent\Model;

class CommonRepository
{
    public function getWithStatus(Model $model, $status = 1, $find_column = false, $find_value = false, $paginateOrSelect = ['*']){

        $data           = CustomHelper::getOrPaginate($paginateOrSelect);
        $getOrPaginate  = $data->getOrPaginate;
        $perPage        = $data->perPage;

        if(!$find_column && !$find_value){
            return $model->where('status', $status)->$getOrPaginate($perPage);
        }
        return $model->where($find_column, $find_value)->where('status', $status)->$getOrPaginate($perPage);
    }
}
