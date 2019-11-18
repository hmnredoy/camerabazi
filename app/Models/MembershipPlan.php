<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TunnelConflux\DevCrud\Models\DevCrudModel;

class MembershipPlan extends DevCrudModel
{
    protected $fillable = ['title', 'amount', 'bids', 'skills', 'coins', 'expire_days', 'order_index', 'status'];

    protected $listColumns = [
        'title', 'price', 'bids', 'skills', 'coins', 'expire_days', 'order_index', 'status'
    ];

    public function getPriceAttribute(){
        return $this->attributes['amount'] ? number_format($this->attributes['amount']) . ' BDT' : 'N\A';
    }
}
