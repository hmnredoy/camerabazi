<?php

namespace App\Models;


use App\Models\Enums\JobStatus;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        return $this->hasOne(Profile::class, 'user_id')->first() ?? null;
    }

    public function skillTools(){
        return $this->belongsToMany(SkillTool::class, 'user_skill_tool', 'user_id', 'skill_tool_id');
    }

    public function locations(){
        return $this->belongsToMany(Location::class, 'user_location', 'user_id', 'location_id');
    }

    public function location(){
        return $this->hasOneThrough(Location::class, UserLocation::class, 'user_id', 'id', 'id', 'location_id')->first() ?? null;
    }


    public function getRatingAttribute(){
        return Review::where('posted_on', $this->id)
                ->avg('rating')
            ? number_format(
                Review::where('posted_on', $this->id)
                ->avg('rating'), 2)
            : 'N\A';
    }


    public function memberships(){
        return $this->hasMany(MembershipPurchase::class, 'freelancer_id', 'id');
    }

    public function ratings(){
        return $this->hasMany(Rating::class, 'user_id');
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

    public function reviews(){
        return $this->hasMany(Review::class, 'posted_on');
    }

    public function account(){
        return $this->hasOne(Account::class);
    }
    // belows are client related methods

    public function getOngoingJobs()
    {
        $ongoingJobs  = new Collection();

        $this->jobs->each(function($job) use ($ongoingJobs) {

            if(!(\Carbon\Carbon::now()->greaterThan($job->expire))  && $job->status != JobStatus::blocked){
                    $ongoingJobs->push($job);
            }
        });

        

        return $ongoingJobs;
    }

    public function getAccountInfoAttribute(){
        return $this->account()->first();
    }

}
