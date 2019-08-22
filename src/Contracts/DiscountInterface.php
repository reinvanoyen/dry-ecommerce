<?php

namespace Tnt\Ecommerce\Contracts;

/**
 * Interface DiscountInterface
 * @package Tnt\Ecommerce\Contracts
 */
interface DiscountInterface
{
	/**
	 * @param BuyableInterface $buyable
	 * @return bool
	 */
	public function isValid(BuyableInterface $buyable): bool;

	/**
	 * @param float $amount
	 * @return float
	 */
	public function applyDiscount(float $amount): float;
}