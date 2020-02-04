<?php

namespace Tnt\Ecommerce\Order;

use Tnt\Ecommerce\Contracts\CartInterface;
use Tnt\Ecommerce\Contracts\CustomerInterface;
use Tnt\Ecommerce\Contracts\OrderFactoryInterface;
use Tnt\Ecommerce\Contracts\OrderIdGeneratorInterface;
use Tnt\Ecommerce\Model\Order;

class OrderFactory implements OrderFactoryInterface
{
    /**
     * @var CartInterface $cart
     */
    private $cart;

    /**
     * @var OrderIdGeneratorInterface $idGenerator
     */
    private $idGenerator;

    /**
     * OrderFactory constructor.
     * @param CartInterface $cart
     * @param OrderIdGeneratorInterface $idGenerator
     */
    public function __construct(CartInterface $cart, OrderIdGeneratorInterface $idGenerator)
    {
        $this->cart = $cart;
        $this->idGenerator = $idGenerator;
    }

    public function create(CustomerInterface $customer): Order
    {
        // Create the order
        $order = new Order();
        $order->created = time();
        $order->updated = time();
        $order->total = $this->cart->getTotal();
        $order->subtotal = $this->cart->getSubTotal();
        $order->reduction = $this->cart->getReduction();
        $order->fulfillment_cost = $this->cart->getFulfillmentCost();
        $order->fulfillment_method = ($this->cart->getFulfillment() ? $this->cart->getFulfillment()->getId() : null);
        $order->discount = $this->cart->getDiscount();
        $order->customer = $customer;
        $order->save();

        // Generate order id
        $order->order_id = $this->idGenerator->generate($order);
        $order->save();

        return $order;
    }
}