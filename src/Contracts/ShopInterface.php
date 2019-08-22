<?php

namespace Tnt\Ecommerce\Contracts;

/**
 * Interface ShopInterface
 * @package Tnt\Ecommerce\Contracts
 */
interface ShopInterface
{
	/**
	 * @param DiscountInterface $discount
	 * @return mixed
	 */
	public function addDiscount(DiscountInterface $discount);

	/**
	 * @return array
	 */
	public function getDiscounts(): array;
}