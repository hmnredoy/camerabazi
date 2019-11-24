<?php

namespace App\Http\Controllers\Helper;

use App\Models\Attachment;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use ReflectionClass;
use stdClass;

class CustomHelper
{
    static function getDistinctData($skillTool, $column, $type){
        $filtered_collection = $skillTool->filter(function ($item) use ($column, $type) {
            if($item->$column == $type) {
                return $item;
            }
        })->values();
        return $filtered_collection;
    }

    static function makeArray(...$args){
        $arr = [];
        foreach ($args as $arg){
            $function = new ReflectionClass($arg[0]);
            $arr[strtolower($function->getShortName())] = $arg;
        }
        return $arr;
    }


    static function store($file) {
        $fileOriginalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $storedFile = $file->storeAs('public/uploads/'.date('Y').'/'.date('m'), uniqid(rand()).time().'.'.$extension);
        $fileSize = round(Storage::size($storedFile) / 1024, 2);
        $fileName = explode('public/', $storedFile)[1];
        $object = new stdClass();
        $object->name = 'storage/'.$fileName;
        $object->size = $fileSize;
        $object->originalName = $fileOriginalName;
        return $object;
    }

    static function addAttachment($model_object, $file){
        $fileData = store($file);

        $response = Attachment::create([
            'url' => $fileData->name,
            'file_size' => $fileData->size,
            'attachmentable_id' => $model_object->id,
            'attachmentable_type' => get_class($model_object) //Model Class Name
        ]);

        if($response){
            return true;
        }
        return false;
    }

    static function deleteWithAttachments($model_object) {
        //dd(get_class($model_object));
        if($model_object->attachments != null){
            foreach ($model_object->attachments as $attachment){
                if(File::exists(public_path($attachment->url))){
                    File::delete(public_path($attachment->url));
                }
                $model_object->attachments()->delete($attachment->id);
            }
        }
        $res = $model_object->delete();

        if($res){
            return true;
        }
        return false;
    }

    /*
     * $args[0] = $rules []
     * $args[1] = $messages []
     * $args[2] = $ignore []
     * $args[3] = $exclude []
    */

    static function validateRequest($model, $request, ...$args){

        /*    dd(func_num_args(), $args);
            $fields = $model->getFillable();
            $table_name = strtolower(str_plural(class_basename($model)));*/

        $unsetItems = [
            'id', 'created_at', 'updated_at'
        ];

        $columns = $model
            ->getConnection()
            ->getSchemaBuilder()
            ->getColumnListing($model->getTable());

        foreach ($unsetItems as $unsetItem){
            if(array_search($unsetItem, $columns) !== false){
                $key = array_search($unsetItem, $columns);
                unset($columns[$key]);
            }
        }

        $validate = [];
        $inputs = $request->all();

        foreach ($columns as $field){
            $validateThis = [
                $field => 'required'
            ];
            $validate = array_merge($validate, $validateThis);
        }

        if(isset($args[0])){
            if(is_array($args[0])){
                $validate = array_merge($validate, $args[0]);
            }
        }

        if(isset($args[2])){
            if(is_array($args[2])){
                foreach ($args[2] as $item){
                    unset($validate[$item]);
                }
            } else{
                unset($validate[$args[2]]);
            }
        }

        if(isset($args[3])){
            if(is_array($args[3]) && !empty($args[3])){
                foreach ($args[3] as $item){
                    if($inputs[$item] != null){
                        $validate = array_merge($validate, [$item => [Rule::notIn([$inputs[$item]]),]]);
                    }
                }
            }
        }

        Validator::make($request->all(), $validate, $args[1] ?? [])->validate();
    }

    static function error($message = 'Failed!', $route = null, $id = null) {
        if($route != null) {
            if($id == null) {
                return redirect()->route($route)->with('error',$message);
            }
            return redirect()->route($route, $id)->with('error',$message);
        }
        return back()->with('error',$message);
    }

    static function success($message = 'Success!', $route = null, $id = null) {
        if($route != null) {

            if($id == null) {
                return redirect()->route($route)->with('success',$message);
            }
            return redirect()->route($route, $id)->with('success',$message);
        }
        return back()->with('success',$message);
    }

    /**
     * @param $paginateOrSelect
     * @return stdClass
     *
     * getOrPaginate expects a parameter that will be a type of array (In cas you want to get all data)
     * E.g : $paginateOrSelect = ['*']
     *
     * getOrPaginate has to be feed with $paginateOrSelect
     * getOrPaginate will return an object.
     * table column names will be returned in $perPage if it has been fed with column names
     * perPage value will be returned otherwise
     *
     * Returns an object : $getOrPaginate, $perPage
     */

    static function getOrPaginate($paginateOrSelect = ['*']){
        $getOrPaginate = 'get';
        $perPage = $paginateOrSelect;
        if(!is_array($paginateOrSelect)){
            $perPage = '*';
        }
        if(is_numeric($paginateOrSelect)){
            $perPage = $paginateOrSelect;
            $getOrPaginate = 'paginate';
        }
        $data = new stdClass;
        $data->getOrPaginate = $getOrPaginate;
        $data->perPage       = $perPage;

        return $data;
    }

}
