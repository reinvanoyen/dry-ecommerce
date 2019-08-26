<?php

namespace Tnt\Ecommerce\Contracts;

/**
 * Interface PaymentInterface
 * @package app\ecommerce
 */
interface PaymentInterface
{
	/**
	 * @return int
	 */
	public function getId(): int;

	/**
	 * @param OrderInterface $order
	 * @return mixed
	 */
	public function pay(OrderInterface $order);

	/**
	 * @return string
	 */
	public function getRedirectUrl(): string;
}