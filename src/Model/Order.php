<?php

namespace Tnt\Ecommerce\Model;

use dry\orm\Model;
use Tnt\Ecommerce\Contracts\CartItemInterface;
use Tnt\Ecommerce\Contracts\CustomerInterface;
use Tnt\Ecommerce\Contracts\FulfillmentMethodInterface;
use Tnt\Ecommerce\Contracts\OrderInterface;

class Order extends Model implements OrderInterface
{
	const TABLE = 'order';

	public static $special_fields = [
		'customer' => Customer::class,
		'fulfillment_method' => FulfillmentMethod::class,
	];

	public function add(CartItemInterface $cartItem)
	{
		$item = new OrderItem();
		$item->order = $this;
		$item->quantity = $cartItem->getQuantity();
		$item->price = $cartItem->getPrice();
		$item->item_id = $cartItem->getBuyable()->getId();
		$item->item_class = get_class($cartItem->getBuyable());
		$item->save();
	}

	public function getItems(): array
	{
		return $this->items;
	}

	public function getTotal(): float
	{
		return $this->total;
	}

	public function setCustomer(CustomerInterface $customer)
	{
		$this->customer = $customer;
		$this->save();
	}

	public function getCustomer(): CustomerInterface
	{
		return $this->customer;
	}

	public function setFulfillmentMethod(FulfillmentMethodInterface $fulfillmentMethod)
	{
		$this->fulfillment_method = $fulfillmentMethod;
		$this->save();
	}

	public function getFulfillmentMethod(): FulfillmentMethodInterface
	{
		return $this->fulfillment_method;
	}

	public function get_items()
	{
		return $this->has_many(OrderItem::class, 'order');
	}
}