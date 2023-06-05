<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderMethod extends Enum
{
    const IMMEDIATE = "home.Cash on Delivery";
    const CardCredit = "home.Debit or Credit Card";
    const ElectronicWallet = "home.E-wallet";
}
