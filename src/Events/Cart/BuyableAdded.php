<?php

namespace Tnt\Ecommerce\Events\Cart;

use Tnt\Ecommerce\Contracts\BuyableInterface;
use Tnt\Ecommerce\Contracts\CartInterface;
use Tnt\Ecommerce\Events\Order\CartEvent;

class BuyableAdded extends CartEvent
{
    /**
     * @var BuyableInterface
     */
    private $buyable;

    /**
     * BuyableAdded constructor.
     * @param CartInterface $cart
     * @param BuyableInterface $buyable
     */
    public function __construct(CartInterface $cart, BuyableInterface $buyable)
    {
        $this->buyable = $buyable;

        parent::__construct($cart);
    }

    /**
     * @return BuyableInterface
     */
    public function getBuyable(): BuyableInterface
    {
        return $this->buyable;
    }
}