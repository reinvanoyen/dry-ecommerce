<?php

namespace Tnt\Ecommerce;

use dry\db\FetchException;
use Oak\Session\Facade\Session;
use Tnt\Ecommerce\Contracts\CartStorageInterface;
use Tnt\Ecommerce\Contracts\StorableInterface;
use Tnt\Ecommerce\Model\Cart;

class SessionCartStorage implements CartStorageInterface
{
    /**
     * @param StorableInterface $cart
     * @return mixed|void
     */
    public function store(StorableInterface $cart)
    {
        Session::set('cart', $cart->getIdentifier());
        Session::save();
    }

    /**
     * @return null|StorableInterface
     */
    public function retrieve(): ?StorableInterface
    {
        try {
            return Cart::load(Session::get('cart'));
        } catch (FetchException $e) {
            //
        }

        return null;
    }

    /**
     * @return mixed|void
     */
    public function clear()
    {
        Session::set('cart', null);
        Session::save();
    }
}