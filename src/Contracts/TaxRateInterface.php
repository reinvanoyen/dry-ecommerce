<?php

namespace Tnt\Ecommerce\Contracts;

interface TaxRateInterface
{
	/**
	 * @param float $amount
	 * @return float
	 */
	public function apply(float $amount): float;
}