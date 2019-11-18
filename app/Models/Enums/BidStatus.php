<?php


namespace App\Models\Enums;


use TunnelConflux\DevCrud\Models\Enums\Enum;

class BidStatus extends Enum
{
    const Inactive  = 0;
    const Active    = 1;
    const Offered   = 2;
    const Rejected  = 3;
    const Accepted  = 4;
    const Cancelled = 5;
    const Dismissed = 6;

}
