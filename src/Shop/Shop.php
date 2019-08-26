<?php

namespace Tnt\Ecommerce\Shop;

use Tnt\Ecommerce\Contracts\DiscountInterface;
use Tnt\Ecommerce\Contracts\FulfillmentInterface;
use Tnt\Ecommerce\Contracts\PaymentInterface;
use Tnt\Ecommerce\Contracts\ShopInterface;

class Shop implements ShopInterface
{
	/**
	 * @var array $payments
	 */
	private $payments = [];

	/**
	 * @var array $fulfillments
	 */
	private $fulfillments = [];

	/**
	 * @var array $discounts
	 */
	private $discounts = [];

	/**
	 * @param PaymentInterface $payment
	 * @return mixed|void
	 */
	public function addPayment(PaymentInterface $payment)
	{
		$this->payments[$payment->getId()] = $payment;
	}

	/**
	 * @param int $id
	 * @return PaymentInterface
	 */
	public function getPayment(int $id): PaymentInterface
	{
		return $this->payments[$id];
	}

	/**
	 * @param int $id
	 * @return bool
	 */
	public function hasPayment(int $id): bool
	{
		return isset($this->payments[$id]);
	}

	/**
	 * @return array
	 */
	public function getPayments(): array
	{
		return $this->payments;
	}

	/**
	 * @param FulfillmentInterface $fulfillment
	 * @return mixed|void
	 */
	public function addFulfillment(FulfillmentInterface $fulfillment)
	{
		$this->fulfillments[$fulfillment->getId()] = $fulfillment;
	}

	/**
	 * @param int $id
	 * @return FulfillmentInterface
	 */
	public function getFulfillment(int $id): FulfillmentInterface
	{
		return $this->fulfillments[$id];
	}

	/**
	 * @param int $id
	 * @return bool
	 */
	public function hasFulfillment(int $id): bool
	{
		return isset($this->fulfillments[$id]);
	}

	/**
	 * @return array
	 */
	public function getFulfillments(): array
	{
		return $this->fulfillments;
	}

	/**
	 * @param DiscountInterface $discount
	 * @return mixed|void
	 */
	public function addDiscount(DiscountInterface $discount)
	{
		$this->discounts[$discount->getId()] = $discount;
	}

	/**
	 * @param int $id
	 * @return DiscountInterface
	 */
	public function getDiscount(int $id): DiscountInterface
	{
		return $this->discounts[$id];
	}

	/**
	 * @return bool
	 */
	public function hasDiscount(DiscountInterface $discount): bool
	{
		return isset($this->discounts[$discount->getId()]);
	}

	/**
	 * @return array
	 */
	public function getDiscounts(): array
	{
		return $this->discounts;
	}
}