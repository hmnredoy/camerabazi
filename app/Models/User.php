<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use TunnelConflux\DevCrud\Models\DevCrudModel;

class User extends AppModel
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','role_id','mobile','status'
    ];

    protected $listColumns = [
      'username', 'email', 'mobile', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role_id' => 'int',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function homePath()
    {
        return $this->role->name.'/home';
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function skillTools(){
        return $this->belongsToMany(SkillTool::class, 'user_skill_tool', 'user_id', 'skill_tool_id');
    }

    public function locations(){
        return $this->belongsToMany(Location::class, 'user_location', 'user_id', 'location_id');
    }

    public function getRatingAttribute(){
        return Review::where('posted_on', $this->id)
                ->avg('rating')
            ? number_format(
                Review::where('posted_on', $this->id)
                ->avg('rating'), 2)
            : 'N\A';
    }

    public function membership(){
        return $this->hasMany(MembershipPurchase::class, 'freelancer_id', 'id');
    }

}
