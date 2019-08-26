<?php

namespace Tnt\Ecommerce\Contracts;

interface ShopInterface
{
	/**
	 * @param PaymentInterface $payment
	 * @return mixed
	 */
	public function addPayment(PaymentInterface $payment);

	/**
	 * @param int $id
	 * @return PaymentInterface
	 */
	public function getPayment(int $id): PaymentInterface;

	/**
	 * @param int $id
	 * @return bool
	 */
	public function hasPayment(int $id): bool;

	/**
	 * @return array
	 */
	public function getPayments(): array;

	/**
	 * @param FulfillmentInterface $fulfillment
	 * @return mixed
	 */
	public function addFulfillment(FulfillmentInterface $fulfillment);

	/**
	 * @param int $id
	 * @return FulfillmentInterface
	 */
	public function getFulfillment(int $id): FulfillmentInterface;

	/**
	 * @param int $id
	 * @return bool
	 */
	public function hasFulfillment(int $id): bool;

	/**
	 * @return array
	 */
	public function getFulfillments(): array;

	/**
	 * @param DiscountInterface $discount
	 * @return mixed
	 */
	public function addDiscount(DiscountInterface $discount);

	/**
	 * @param int $id
	 * @return DiscountInterface
	 */
	public function getDiscount(int $id): DiscountInterface;

	/**
	 * @return bool
	 */
	public function hasDiscount(DiscountInterface $discount): bool;

	/**
	 * @return array
	 */
	public function getDiscounts(): array;
}