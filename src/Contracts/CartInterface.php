<?php

namespace Tnt\Ecommerce\Contracts;

/**
 * Interface CartInterface
 * @package Tnt\Ecommerce\Contracts
 */
interface CartInterface
{
	/**
	 * @param BuyableInterface $buyable
	 * @param int $quantity
	 * @return mixed
	 */
	public function add(BuyableInterface $buyable, int $quantity = 1);

	/**
	 * @return array
	 */
	public function items(): array;

	/**
	 * @param CartItemInterface $cartItem
	 * @return mixed
	 */
	public function remove(CartItemInterface $cartItem);

	/**
	 * @return mixed
	 */
	public function clear();

	/**
	 * @param FulfillmentMethodInterface $fulfillmentMethod
	 * @return mixed
	 */
	public function setFulfillmentMethod(FulfillmentMethodInterface $fulfillmentMethod);

	/**
	 * @return null|FulfillmentMethodInterface
	 */
	public function getFulfillmentMethod(): ?FulfillmentMethodInterface;

	/**
	 * @return FulfillmentMethodCollectionInterface
	 */
	public function getFulfillmentMethods(): FulfillmentMethodCollectionInterface;

	/**
	 * @return float
	 */
	public function getFulfillmentCost(): float;

	/**
	 * @param DiscountInterface $discount
	 * @return mixed
	 */
	public function addDiscount(DiscountInterface $discount);

	/**
	 * @return float
	 */
	public function getSubTotal(): float;

	/**
	 * @return float
	 */
	public function getTotal(): float;

	/**
	 * @param CustomerInterface $customer
	 * @return OrderInterface
	 */
	public function checkout(CustomerInterface $customer): OrderInterface;
}