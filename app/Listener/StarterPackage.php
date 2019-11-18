<?php

namespace App\Listener;

use App\Models\FreelancerAccount;
use App\Models\Package;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StarterPackage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {

        if($event->user->role->name === 'freelancer'){

            $package = Package::find(1);
            $package->users()->save($event->user);

            $account = new FreelancerAccount();
            $account->bid = $package->bid_per_month;
            $account->coin = $package->coin_per_month;
            $account->balance = 0;

            $event->user->account()->save($account);

        }

    }
}
