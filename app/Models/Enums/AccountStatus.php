<?php


namespace App\Models\Enums;


use TunnelConflux\DevCrud\Models\Enums\Enum;

class AccountStatus extends Enum
{
    const Inctive   = 0;
    const Active    = 1;
    const Stalled   = 2; //Temporary
}
