<?php

namespace Tnt\Ecommerce;

use Oak\Contracts\Container\ContainerInterface;
use Oak\ServiceProvider;
use Tnt\Ecommerce\Cart\Cart;
use Tnt\Ecommerce\Contracts\CartInterface;
use Tnt\Ecommerce\Contracts\ShopInterface;
use Tnt\Ecommerce\Contracts\StockWorkerInterface;
use Tnt\Ecommerce\Shop\Shop;
use Tnt\Ecommerce\Stock\StockWorker;

class EcommerceServiceProvider extends ServiceProvider
{
	public function boot(ContainerInterface $app)
	{
		//
	}

	public function register(ContainerInterface $app)
	{
		$app->singleton(ShopInterface::class, Shop::class);
		$app->singleton(CartInterface::class, Cart::class);
		$app->set(StockWorkerInterface::class, StockWorker::class);
	}
}