<?php

namespace App\Payment;

interface PaymentMethodInterface
{
    public function pay(): string;
}
