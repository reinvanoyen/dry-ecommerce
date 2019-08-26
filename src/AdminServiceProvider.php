<?php

namespace Tnt\Ecommerce;

use dry\admin\Router;
use Oak\Contracts\Container\ContainerInterface;
use Oak\ServiceProvider;
use Tnt\Ecommerce\Admin\CountryManager;
use Tnt\Ecommerce\Admin\FulfillmentMethodManager;
use Tnt\Ecommerce\Admin\StockManager;

class AdminServiceProvider extends ServiceProvider
{
	public function boot(ContainerInterface $app)
	{
		$this->registerAdmin();
	}

	public function register(ContainerInterface $app)
	{
		//
	}

	private function registerAdmin()
	{
		Router::$modules[] = new CountryManager();
		Router::$modules[] = new FulfillmentMethodManager();
		Router::$modules[] = new StockManager();
	}
}