<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderMethod extends Enum
{
    const IMMEDIATE =   "Payment on delivery";
    const CardCredit =   "Debit or Credit Card";
    const ElectronicWallet = "Electronic Wallet";
}
