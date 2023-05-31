<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UserStatus extends Enum
{
    const ACTIVE =   "ACTIVE";
    const INACTIVE =   "INACTIVE";
    const BAN =   "BAN";
    const DELETED =   "DELETED";
}
