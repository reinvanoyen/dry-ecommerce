<?php

namespace Tnt\Ecommerce\Fulfillment;

use Tnt\Ecommerce\Contracts\FulfillmentMethodCollectionInterface;
use Tnt\Ecommerce\Contracts\FulfillmentMethodInterface;

/**
 * Class Collection
 * @package Tnt\Ecommerce\Fulfillment
 */
class Collection implements FulfillmentMethodCollectionInterface
{
	/**
	 * @var array
	 */
	private $fulfillmentMethods = [];

	/**
	 * @param int $id
	 * @return FulfillmentMethodInterface
	 */
	public function get(int $id): FulfillmentMethodInterface
	{
		return $this->fulfillmentMethods[$id];
	}

	/**
	 * @param int $id
	 * @return bool
	 */
	public function has(int $id): bool
	{
		return isset($this->fulfillmentMethods[$id]);
	}

	/**
	 * @param FulfillmentMethodInterface $fulfillmentMethod
	 * @return mixed|void
	 */
	public function add(FulfillmentMethodInterface $fulfillmentMethod)
	{
		if ($this->has($fulfillmentMethod->getId())) {
			return;
		}

		$this->fulfillmentMethods[$fulfillmentMethod->getId()] = $fulfillmentMethod;
	}

	/**
	 * @return array
	 */
	public function all(): array
	{
		return $this->fulfillmentMethods;
	}
}