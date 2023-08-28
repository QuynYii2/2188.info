<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class MessageStatus extends Enum
{
    const SEEN = 'SEEN';
    const UNSEEN = 'UNSEEN';
    const HIDDEN = 'HIDDEN';
    const DELETED = 'DELETED';
}
