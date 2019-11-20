<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientOffer extends Model
{
    protected $guarded = [];

    public function bid(){
        return $this->belongsTo(Bid::class);
    }
}
