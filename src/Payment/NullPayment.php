<?php

namespace Tnt\Ecommerce\Payment;

use Tnt\Ecommerce\Contracts\OrderInterface;
use Tnt\Ecommerce\Contracts\PaymentInterface;

class NullPayment implements PaymentInterface
{
    public function pay(OrderInterface $order)
    {
        // Do nothing...
    }
}