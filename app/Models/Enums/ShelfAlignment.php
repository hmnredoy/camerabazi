<?php
/**
 * Project      : Loreal TMR Automation
 * File Name    : BrandTypes.php
 * Author       : Abu Bakar Siddique
 * Email        : absiddique.live@gmail.com
 * Date[Y/M/D]  : 2019/07/30 5:16 PM
 */

namespace App\Models\Enums;

use TunnelConflux\DevCrud\Models\Enums\Enum;

class ShelfAlignment extends Enum
{
    const full       = 1;
    const vertical   = 2;
    const horizontal = 3;
}
