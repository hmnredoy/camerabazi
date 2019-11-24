<?php


namespace App\Models\Enums;


use TunnelConflux\DevCrud\Models\Enums\Enum;

class MembershipStatus extends Enum
{
    const Inactive = 0;
    const Active = 1;
    const Stall = 2;

}
