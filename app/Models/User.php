<?php

namespace App\Models;


use App\Models\Enums\JobStatus;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
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
        'name', 'email', 'password','roll_id','mobile','status'
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

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function account()
    {
        return $this->hasOne(FreelancerAccount::class,'freelancer_id');
    }




    // this methods belongs to a freelancer account

    public function bids()  // get all bids done by freelancer
    {
       return $this->hasMany(Bid::class,'freelancer_id');
    }

    public function getSubmittedBids()
    {
        return $this->bids;
    }

    public function getActivedBids()
    {

        $bids  = new Collection();

        $this->bids->each(function($bid) use ($bids) {
            if(! \Carbon\Carbon::now()->greaterThan($bid->job->expire)){
                $bids->push($bid);
            }
        });


       return $bids;



    }

    public function getOngoingBids()
    {
        $bids  = new Collection();

        $this->bids->each(function($bid) use ($bids) {
            if(!(\Carbon\Carbon::now()->greaterThan($bid->job->expire)) && $bid->is_accepted){

                $bids->push($bid);
            }
        });



        return $bids;
    }

    public function getCanceledJobs()
    {
        $jobs  = new Collection();

        $this->bids->each(function($bid) use ($jobs) {
            if($bid->job->status == JobStatus::cancelled ){
                $jobs->push($bid->job);
            }
        });


        return $jobs;
    }

    public function getSucceededJobs()
    {
        $jobs  = new Collection();

        $this->bids->each(function($bid) use ($jobs) {
            if($bid->job->status == JobStatus::succeeded ){
                $jobs->push($bid->job);
            }
        });


        return $jobs;
    }




}
