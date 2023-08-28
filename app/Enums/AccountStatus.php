<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AccountStatus extends Enum
{
    const ONLINE = 'ONLINE';
    const OFFLINE = 'OFFLINE';
    const BUSY = 'BUSY';
}
