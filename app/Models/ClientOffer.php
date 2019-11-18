<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientOffer extends Model
{
//    protected $fillable = ['amount', 'delivery_days', 'message'];

    protected $guarded = [];

    public function bid(){
        return $this->belongsTo(Bid::class);
    }
}
