<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TransactionStatus extends Enum
{
    const SUCCESS =   'SUCCESS';
    const FAIL =   'FAIL';
    const DELETED = 'DELETED';
}
