<?php

namespace Tnt\Ecommerce\Contracts;

/**
 * Interface FulfillmentMethodInterface
 * @package Tnt\Ecommerce\Contracts
 */
interface FulfillmentMethodInterface
{
	/**
	 * @param CartInterface $cart
	 * @return float
	 */
	public function getCost(CartInterface $cart): float;

	/**
	 * @return string
	 */
	public function getTitle(): string;

	/**
	 * @return int
	 */
	public function getId(): int;

	/**
	 * @param string $name
	 * @return mixed
	 */
	public function getAttribute(string $name);

	/**
	 * @param string $name
	 * @param $value
	 * @return mixed
	 */
	public function setAttribute(string $name, $value);

	/**
	 * @param string $name
	 * @return bool
	 */
	public function hasAttribute(string $name): bool;

	/**
	 * @return bool
	 */
	public function validateAttributes(): bool;


	/**
	 * @return array
	 */
	public function requireAttributes(): array;
}