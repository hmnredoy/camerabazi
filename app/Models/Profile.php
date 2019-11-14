<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profile';

    protected $fillable = ['user_id', 'gender', 'phone', 'profile_image', 'cover_image', 'bid', 'coin', 'tag_line', 'description'];

    public function locations(){
        return $this->belongsToMany(Location::class, 'user_location', 'user_id', 'location_id');
    }

    public function skillTools(){
        return $this->belongsToMany(SkillTool::class, 'user_skill_tool', 'user_id', 'skill_tool_id');
    }

    public function portfolios(){
        return $this->hasMany(Portfolio::class, 'user_id', 'user_id');
    }

    public function experiences(){
        return $this->hasMany(Experience::class, 'user_id', 'user_id');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
