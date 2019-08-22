<?php

namespace Tnt\Ecommerce\Contracts;

/**
 * Interface CouponInterface
 * @package Tnt\Ecommerce\Contracts
 */
interface CouponInterface
{
	/**
	 * @return bool
	 */
	public function isRedeemable(): bool;
}