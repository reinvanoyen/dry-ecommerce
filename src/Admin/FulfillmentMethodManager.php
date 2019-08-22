<?php

namespace Tnt\Ecommerce\Admin;

use dry\admin\component\EnumEdit;
use dry\admin\component\EnumView;
use dry\admin\component\StringEdit;
use dry\admin\component\StringView;
use dry\orm\action\Create;
use dry\orm\action\Delete;
use dry\orm\action\Edit;
use dry\orm\Index;
use dry\orm\Manager;
use Tnt\Ecommerce\Model\FulfillmentMethod;

class FulfillmentMethodManager extends Manager
{
	public function __construct()
	{
		parent::__construct(FulfillmentMethod::class, [
			'icon' => self::ICON_CATEGORY,
			'singular' => 'fulfillment method',
		]);

		$this->actions[] = $create = new Create([
			new StringEdit('title', [
				'v8n_required' => TRUE,
				'suggest_slug' => 'slug',
			]),
			new EnumEdit('type', [
				[FulfillmentMethod::FULFILL_TYPE_SHIPPING, 'Shipping',],
				[FulfillmentMethod::FULFILL_TYPE_PICKUP, 'Pickup',],
			])
		], [
			'mode' => Create::MODE_POPUP,
		]);

		$this->actions[] = $edit = new Edit($create->components, [
			'mode' => Create::MODE_POPUP,
		]);

		$this->actions[] = $delete = new Delete();

		$this->header[] = $create->create_link('Add fulfillment method');

		$this->index = new Index([
			new StringView('title'),
			new EnumView('type', [
				[FulfillmentMethod::FULFILL_TYPE_SHIPPING, 'Shipping',],
				[FulfillmentMethod::FULFILL_TYPE_PICKUP, 'Pickup',],
			]),
			$edit->create_link(),
			$delete->create_link(),
		]);
	}
}