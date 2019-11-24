<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreelancerAccount extends Model
{
    public function owner()
    {
        return $this->hasOne(User::class);
    }
}
