<?php

namespace App\Payment;

class StripePayment implements PaymentMethodInterface, IterablePaymentMethodInterface
{
    public function pay(): string
    {
        return 'You paid with Stripe';
    }

    public static function getDefaultIndexName(): string
    {
        return 'stripe';
    }
}
