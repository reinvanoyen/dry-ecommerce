<?php

namespace Tnt\Ecommerce;

use dry\admin\Router;
use Oak\Contracts\Container\ContainerInterface;
use Oak\ServiceProvider;
use Tnt\Ecommerce\Admin\CountryManager;
use Tnt\Ecommerce\Admin\FulfillmentMethodManager;
use Tnt\Ecommerce\Admin\StockManager;
use Tnt\Ecommerce\Cart\Cart;
use Tnt\Ecommerce\Contracts\CartInterface;
use Tnt\Ecommerce\Contracts\FulfillmentMethodCollectionInterface;
use Tnt\Ecommerce\Contracts\ShopInterface;
use Tnt\Ecommerce\Contracts\StockWorkerInterface;
use Tnt\Ecommerce\Fulfillment\Collection;
use Tnt\Ecommerce\Fulfillment\Method\DigitalDelivery;
use Tnt\Ecommerce\Model\FulfillmentMethod;
use Tnt\Ecommerce\Shop\Shop;
use Tnt\Ecommerce\Stock\StockWorker;

class EcommerceServiceProvider extends ServiceProvider
{
	public function boot(ContainerInterface $app)
	{
		$this->registerAdmin();
		$this->registerFulfillmentMethods($app);
	}

	public function register(ContainerInterface $app)
	{
		$app->singleton(CartInterface::class, Cart::class);
		$app->singleton(FulfillmentMethodCollectionInterface::class, Collection::class);
		$app->singleton(ShopInterface::class, Shop::class);
		$app->set(StockWorkerInterface::class, StockWorker::class);
	}
	
	private function registerAdmin()
	{
		Router::$modules[] = new CountryManager();
		Router::$modules[] = new FulfillmentMethodManager();
		Router::$modules[] = new StockManager();
	}

	private function registerFulfillmentMethods(ContainerInterface $app)
	{
		$collection = $app->get(FulfillmentMethodCollectionInterface::class);

		foreach (FulfillmentMethod::all() as $f) {
			$collection->add($f);
		}

		$collection->add(new DigitalDelivery());
	}
}