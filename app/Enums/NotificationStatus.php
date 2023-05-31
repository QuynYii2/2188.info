<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class NotificationStatus extends Enum
{
    const SEEN =  'SEEN';
    const UNSEEN =   'UNSEEN';
    const DELETED = 'DELETED';
}
