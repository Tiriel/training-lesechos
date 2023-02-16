<?php

namespace App\Payment;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('app.payment_method')]
interface IterablePaymentMethodInterface
{
    public static function getDefaultIndexName(): string;
}
