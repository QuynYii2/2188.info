<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CartStatus extends Enum
{
    const WAIT_ORDER =   "WAIT ORDER";
    const ORDERED =   "ORDERED";
    const DELETED = "DELETED";
}
