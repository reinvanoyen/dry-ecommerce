<?php

namespace Tnt\Ecommerce\Contracts;

/**
 * Interface DiscountInterface
 * @package Tnt\Ecommerce\Contracts
 */
interface DiscountInterface
{
	/**
	 * @return int
	 */
	public function getId(): int;

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