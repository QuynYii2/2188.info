<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderMethod extends Enum
{
    const IMMEDIATE = "home.Cash on Delivery";
    const SHOPPING_MALL_COIN = "home.coin";
    const CardCredit = "home.Debit or Credit Card";
    const ElectronicWallet = "home.E-wallet";
}
