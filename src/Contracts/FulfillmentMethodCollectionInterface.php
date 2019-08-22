<?php

namespace Tnt\Ecommerce\Contracts;

/**
 * Interface FulfillmentMethodCollectionInterface
 * @package Tnt\Ecommerce\Contracts
 */
interface FulfillmentMethodCollectionInterface
{
	/**
	 * @param int $id
	 * @return FulfillmentMethodInterface
	 */
	public function get(int $id): FulfillmentMethodInterface;

	/**
	 * @param int $id
	 * @return bool
	 */
	public function has(int $id): bool;

	/**
	 * @param FulfillmentMethodInterface $fulfillmentMethod
	 * @return mixed
	 */
	public function add(FulfillmentMethodInterface $fulfillmentMethod);

	/**
	 * @return array
	 */
	public function all(): array;
}