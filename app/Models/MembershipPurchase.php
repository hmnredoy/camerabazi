<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//\Carbon\Carbon::setToStringFormat('d-m-Y');

class MembershipPurchase extends Model
{
    protected $table = 'membership_purchase';
    protected $guarded = [];

    public function membership(){
        return $this->belongsTo(MembershipPlan::class, 'membership_id', 'id');
    }

    protected $dates = ['created_at', 'expire', 'updated_at'];

    public function freelancer(){
        return $this->belongsTo(User::class, 'freelancer_id');
    }
}
