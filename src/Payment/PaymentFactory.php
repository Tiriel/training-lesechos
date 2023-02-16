<?php

namespace App\Payment;

use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

class PaymentFactory implements PaymentMethodInterface
{
    private iterable $payments;
    public function __construct(

        #[TaggedIterator('app.payment_method', defaultIndexMethod: 'getDefaultIndexName')]
        iterable $payments
    ) {
        $this->payments = $payments instanceof \Traversable ? iterator_to_array($payments) : $payments;
    }

    public function pay(string $payment = ''): string
    {
        return $this->payments[$payment]->pay();
    }
}
