<?php

namespace App\Payment;

class PaypalPayment implements PaymentMethodInterface, IterablePaymentMethodInterface
{
    public function pay(): string
    {
        return 'You paid with PayPal';
    }

    public static function getDefaultIndexName(): string
    {
        return 'paypal';
    }
}
