<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PostRFQStatus extends Enum
{
    const APPROVED = 'APPROVED';
    const PENDING = 'PENDING';
    const REFUSE = 'REFUSE';
    const DELETED = 'DELETED';
}
