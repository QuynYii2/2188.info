<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PromotionStatus extends Enum
{
    const ACTIVE = 'ACTIVE';
    const INACTIVE = 'INACTIVE';
    const DELETED = 'DELETED';
}
