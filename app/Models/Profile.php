<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';

    public function locations(){
        return $this->belongsToMany(Location::class, 'user_location', 'user_id', 'location_id');
    }

    public function skills(){
        return $this->belongsToMany(Skill::class, 'user_skill', 'user_id', 'skill_id');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
