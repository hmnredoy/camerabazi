<?php


namespace App\Models\Enums;


use TunnelConflux\DevCrud\Models\Enums\Enum;

class OfferStatus extends Enum
{
    const Inctive    = 0;
    const Active     = 1;
    const Accepted   = 2;
    const Cancelled  = 3;
}
