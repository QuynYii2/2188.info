<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class RegisterMemberPrice extends Enum
{
    const VENDOR = 100;
    const POWER_VENDOR = 200;
    const PRODUCTION = 500;
    const POWER_PRODUCTION = 1000;
}
