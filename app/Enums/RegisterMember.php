<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class RegisterMember extends Enum
{
    // Member free
    const BUYER = 'BUYER';
    const TRUST = 'TRUST';
    const LOGISTIC = 'LOGISTIC';
    // Start member buy with money
    const VENDOR = 'VENDOR';
    const POWER_VENDOR = 'POWER VENDOR';
    const PRODUCTION = 'PRODUCTION';
    const POWER_PRODUCTION = 'POWER PRODUCTION';
}
