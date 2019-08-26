<?php

namespace Tnt\Ecommerce\Payment;

use Tnt\Ecommerce\Contracts\OrderInterface;
use Tnt\Ecommerce\Contracts\PaymentInterface;

class Free implements PaymentInterface
{
	public function getId(): int
	{
		return 0;
	}

	public function pay(OrderInterface $order)
	{
		// Do nothing...

		// ...and clear the cart
		\Tnt\Ecommerce\Facade\Cart::clear();
	}

	public function getRedirectUrl(): string
	{
		return \dry\url('cart::paymentSuccess');
	}
}