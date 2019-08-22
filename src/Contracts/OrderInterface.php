<?php

namespace Tnt\Ecommerce\Contracts;

/**
 * Interface OrderInterface
 * @package Tnt\Ecommerce\Contracts
 */
interface OrderInterface
{
	/**
	 * @param CartItemInterface $cartItem
	 * @return mixed
	 */
	public function add(CartItemInterface $cartItem);

	/**
	 * @return array
	 */
	public function getItems(): array;

	/**
	 * @return float
	 */
	public function getTotal(): float;

	/**
	 * @param CustomerInterface $customer
	 * @return mixed
	 */
	public function setCustomer(CustomerInterface $customer);

	/**
	 * @return CustomerInterface
	 */
	public function getCustomer(): CustomerInterface;

	/**
	 * @return mixed
	 */
	public function setFulfillmentMethod(FulfillmentMethodInterface $fulfillmentMethod);

	/**
	 * @return FulfillmentMethodInterface
	 */
	public function getFulfillmentMethod(): FulfillmentMethodInterface;
}