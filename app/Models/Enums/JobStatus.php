<?php

namespace App\Models\Enums;

use TunnelConflux\DevCrud\Models\Enums\Enum;

class JobStatus extends Enum
{
    const Active    = 1;
    const Submitted = 2;
    const Cancelled = 3;
    const Succeeded = 4;
    const Ongoing   = 5;
    const Ended     = 6;
    const Blocked   = 7;
}
