<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PermissionUserStatus extends Enum
{
    const ACTIVE =   'ACTIVE';
    const INACTIVE =   'INACTIVE';
    const EXPIRED =   'EXPIRED';
    const DELETED = 'DELETED';
}
