<?php

namespace Tnt\Ecommerce\Model;

use dry\orm\Model;

class StockItem extends Model
{
	const TABLE = 'stock_item';

	public static $special_fields = [
		'stock' => Stock::class,
	];
}