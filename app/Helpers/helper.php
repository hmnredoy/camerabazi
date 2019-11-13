<?php

use App\Models\Attachment;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
