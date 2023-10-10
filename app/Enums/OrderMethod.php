<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderMethod extends Enum
{
    const IMMEDIATE = "Cash on Delivery";
    const SHOPPING_MALL_COIN = "coin";
    const CardCredit = "Debit or Credit Card";
    const ElectronicWallet = "E-wallet";
}
