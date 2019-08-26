<?php

namespace Tnt\Ecommerce\Discount;

use Tnt\Ecommerce\Contracts\BuyableInterface;
use Tnt\Ecommerce\Contracts\DiscountInterface;

class SummerSale implements DiscountInterface
{
	public function getId(): int
	{
		return 1;
	}

	public function isValid(BuyableInterface $buyable): bool
	{
		$month = (int) date('m');

		return ($month >= 6 && $month <= 8);
	}

	public function applyDiscount(float $amount): float
	{
		return $amount / 2;
	}
}