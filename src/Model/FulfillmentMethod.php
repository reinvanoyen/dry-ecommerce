<?php

namespace Tnt\Ecommerce\Model;

use dry\orm\Model;
use Tnt\Ecommerce\Contracts\CartInterface;
use Tnt\Ecommerce\Contracts\FulfillmentMethodInterface;
use Tnt\Ecommerce\Fulfillment\HasFulfillmentAttributes;
use Tnt\Ecommerce\Fulfillment\MissingAttribute;

class FulfillmentMethod extends Model implements FulfillmentMethodInterface
{
	use HasFulfillmentAttributes;

	const TABLE = 'fulfillment_method';

	const FULFILL_TYPE_SHIPPING = 0;
	const FULFILL_TYPE_PICKUP = 1;

	/**
	 * @param CartInterface $cart
	 * @return float
	 * @throws \Tnt\Ecommerce\Fulfillment\MissingAttribute
	 */
	public function getCost(CartInterface $cart): float
	{
		if ($this->type === self::FULFILL_TYPE_SHIPPING) {
			try {
				return $this->getAttribute('country')->shipping_cost;
			} catch (MissingAttribute $e) {
				if ($e->getAttributeName() === 'country') {
					$this->setAttribute('country', Country::one());
				}

				return $this->getCost($cart);
			}
		} else if ($this->type === self::FULFILL_TYPE_PICKUP) {
			try {
				return strlen($this->getAttribute('name')) + $this->getAttribute('shippingCost');
			} catch (MissingAttribute $e) {

				if ($e->getAttributeName() === 'name') {
					$this->setAttribute('name', 'dieter');
				}

				if ($e->getAttributeName() === 'shippingCost') {
					$this->setAttribute('shippingCost', 25);
				}

				return $this->getCost($cart);
			}
		}

		return 0;
	}

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @return array
	 */
	public function requireAttributes(): array
	{
		if ($this->type === self::FULFILL_TYPE_SHIPPING) {
			return ['country',];
		}

		if ($this->type === self::FULFILL_TYPE_PICKUP) {
			return ['name', 'shippingCost',];
		}

		return [];
	}
}