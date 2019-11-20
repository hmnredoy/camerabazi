<?php

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

function store($file) {
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

function addAttachment($model_object, $file){
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

function deleteWithAttachments($model_object) {
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

function validateRequest($model, $request, ...$args){

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

function error($message = 'Failed!', $route = null, $id = null) {
    if($route != null) {
        if($id == null) {
            return redirect()->route($route)->with('error',$message);
        }
        return redirect()->route($route, $id)->with('error',$message);
    }
    return back()->with('error',$message);
}

function success($message = 'Success!', $route = null, $id = null) {
    if($route != null) {

        if($id == null) {
            return redirect()->route($route)->with('success',$message);
        }
        return redirect()->route($route, $id)->with('success',$message);
    }
    return back()->with('success',$message);
}
