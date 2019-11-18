<?php

namespace App\Models\Enums;

use TunnelConflux\DevCrud\Models\Enums\Enum;

class JobStatus extends Enum
{
    const submitted = 1;
    const cancelled = 2;
    const succeeded = 3;
    const ongoing   = 4;
    const blocked  = 5;
}
