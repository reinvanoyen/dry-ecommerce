<?php

namespace Tnt\Ecommerce\Cart;

use dry\db\FetchException;
use Oak\Dispatcher\Facade\Dispatcher;
use Oak\Session\Facade\Session;
use Tnt\Ecommerce\Contracts\BuyableInterface;
use Tnt\Ecommerce\Contracts\CartInterface;
use Tnt\Ecommerce\Contracts\CartItemInterface;
use Tnt\Ecommerce\Contracts\CustomerInterface;
use Tnt\Ecommerce\Contracts\DiscountInterface;
use Tnt\Ecommerce\Contracts\FulfillmentInterface;
use Tnt\Ecommerce\Contracts\OrderInterface;
use Tnt\Ecommerce\Events\Order\Created;
use Tnt\Ecommerce\Facade\Shop;
use Tnt\Ecommerce\Model\CartItem;
use Tnt\Ecommerce\Model\Order;

/**
 * Class Cart
 * @package Tnt\Ecommerce\Cart
 */
class Cart implements CartInterface
{
	/**
	 * @var \Tnt\Ecommerce\Model\Cart $cart
	 */
	private $cart;

	/**
	 * Cart constructor.
	 */
	public function __construct()
	{
		$this->restore();
	}

	/**
	 * Restores the cart
	 */
	private function restore()
	{
		if (Session::has('cart')) {
			try {
				$this->cart = \Tnt\Ecommerce\Model\Cart::load(Session::get('cart'));
				return;
			} catch (FetchException $e) {}
		}

		$cart = new \Tnt\Ecommerce\Model\Cart();
		$cart->created = time();
		$cart->updated = time();
		$cart->save();

		Session::set('cart', $cart->id);
		Session::save();

		$this->cart = $cart;
	}

	/**
	 * @param BuyableInterface $buyable
	 * @param int $quantity
	 * @return mixed|void
	 */
	public function add(BuyableInterface $buyable, int $quantity = 1)
	{
		$item_class = get_class($buyable);

		try {
			$cart_item = CartItem::load_by([
				'cart' => $this->cart->id,
				'item_id' => $buyable->getId(),
				'item_class' => $item_class,
			]);

			$cart_item->setQuantity($cart_item->getQuantity() + $quantity);

		} catch (FetchException $e) {

			$cart_item = new CartItem();
			$cart_item->created = time();
			$cart_item->updated = time();
			$cart_item->cart = $this->cart->id;
			$cart_item->item_id = $buyable->getId();
			$cart_item->item_class = $item_class;
			$cart_item->quantity = $quantity;
			$cart_item->save();
		}
	}

	/**
	 * @return array
	 */
	public function items(): array
	{
		return $this->cart->items->to_array();
	}

	/**
	 * @param CartItemInterface $cartItem
	 * @return mixed|void
	 */
	public function remove(CartItemInterface $cartItem)
	{
		$cartItem->delete();
	}

	/**
	 * @return mixed|void
	 */
	public function clear()
	{
		if ($this->cart) {
			$this->cart->delete();
		}

		Session::set('cart', null);
		Session::save();
	}

	/**
	 * @param FulfillmentInterface $fulfillment
	 * @return mixed|void
	 */
	public function setFulfillment(FulfillmentInterface $fulfillment)
	{
		if (! Shop::hasFulfillment($fulfillment->getId())) {
			return;
		}

		$this->cart->fulfillment_method = $fulfillment->getId();
		$this->cart->save();
	}

	/**
	 * @return null|FulfillmentInterface
	 */
	public function getFulfillment(): ?FulfillmentInterface
	{
		$id = $this->cart->fulfillment_method;

		if (! $id || ! Shop::hasFulfillment($id)) {
			return null;
		}

		return Shop::getFulfillment($id);
	}

	/**
	 * @return float
	 */
	public function getFulfillmentCost(): float
	{
		$fulfill = $this->getFulfillment();

		if ($fulfill) {
			return $fulfill->getCost($this);
		}

		return 0;
	}

	/**
	 * @param DiscountInterface $discount
	 * @return mixed|void
	 */
	public function addDiscount(DiscountInterface $discount)
	{
		// TODO: Implement addDiscount() method.
	}

	/**
	 * @return float
	 */
	public function getSubTotal(): float
	{
		$cost = 0;

		foreach ($this->items() as $item) {
			$cost += $item->getPrice();
		}

		return $cost;
	}

	/**
	 * @return float
	 */
	public function getTotal(): float
	{
		return $this->getSubTotal() + $this->getFulfillmentCost();
	}

	/**
	 * @param CustomerInterface $customer
	 * @return OrderInterface
	 */
	public function checkout(CustomerInterface $customer): OrderInterface
	{
		// Create the order
		$order = new Order();
		$order->created = time();
		$order->updated = time();
		$order->total = self::getTotal();
		$order->subtotal = self::getSubTotal();
		$order->fulfillment_cost = self::getFulfillmentCost();
		$order->fulfillment_method = self::getFulfillment();
		$order->customer = $customer;
		$order->save();

		// Generate an order id
		$start = rand(5, 8);
		$rest = 8 - $start;

		$order->order_id = $order->id.'-'.\dry\util\string\random($start).'_'.\dry\util\string\random($rest);
		$order->save();

		// Add all items to the order
		foreach ($this->items() as $item) {
			$order->add($item);
		}

		Dispatcher::dispatch(Created::class, new Created($order));

		return $order;
	}
}