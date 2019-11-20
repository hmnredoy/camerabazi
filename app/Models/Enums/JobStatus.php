<?php

namespace App\Models\Enums;

use TunnelConflux\DevCrud\Models\Enums\Enum;

class JobStatus extends Enum
{
    const active    = 1;
    const submitted = 2;
    const cancelled = 3;
    const succeeded = 4;
    const ongoing   = 5;
    const ended     = 6;
    const blocked   = 7;
}
