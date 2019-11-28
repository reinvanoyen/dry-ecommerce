<?php

namespace Tnt\Ecommerce;

use Tnt\Ecommerce\Contracts\CartFactoryInterface;
use Tnt\Ecommerce\Contracts\StorableInterface;

class CartFactory implements CartFactoryInterface
{
    public function create(): StorableInterface
    {
        $cart = new \Tnt\Ecommerce\Model\Cart();
        $cart->created = time();
        $cart->updated = time();
        $cart->save();

        return $cart;
    }
}