<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class BannerStatus extends Enum
{
    const ACTIVE =   'ACTIVE';
    const INACTIVE =   'INACTIVE';
    const DELETED = 'DELETED';
}
