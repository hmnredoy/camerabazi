<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $table = 'attachments';

    protected $fillable = ['url', 'file_size', 'attachmentable_id', 'attachmentable_type'];

    public $timestamps = false;

    public function attachmentable(){
        return $this->morphTo();
    }
}
