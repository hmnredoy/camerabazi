<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','roll_id','username','mobile','status'
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
        'role_id' => 'int'
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




}
