<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AddressOrderOption extends Enum
{
    const HOME_PRIVATE =   "Home";
    const COMPANY =   'Company';
    const NATION =   'nation';
    const STATE =   'state';
    const CITY =   'city';
}
