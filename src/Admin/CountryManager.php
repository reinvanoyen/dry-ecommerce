<?php

namespace Tnt\Ecommerce\Admin;

use dry\admin\component\FloatEdit;
use dry\admin\component\StringEdit;
use dry\admin\component\StringView;
use dry\orm\action\Create;
use dry\orm\action\Delete;
use dry\orm\action\Edit;
use dry\orm\Index;
use dry\orm\Manager;
use Tnt\Ecommerce\Model\Country;

class CountryManager extends Manager
{
	public function __construct()
	{
		parent::__construct(Country::class, [
			'icon' => self::ICON_CATEGORY,
			'singular' => 'country',
			'plural' => 'countries',
		]);

		$this->actions[] = $create = new Create([
			new StringEdit('name', [
				'v8n_required' => TRUE,
			]),
			new StringEdit('iso', [
				'v8n_required' => TRUE,
			]),
			new FloatEdit('shipping_cost'),
		], [
			'mode' => Create::MODE_POPUP,
		]);

		$this->actions[] = $edit = new Edit($create->components, [
			'mode' => Create::MODE_POPUP,
		]);

		$this->actions[] = $delete = new Delete();

		$this->header[] = $create->create_link('Add country');

		$this->index = new Index([
			new StringView('name'),
			new StringView('iso'),
			new StringView('shipping_cost'),
			$edit->create_link(),
			$delete->create_link(),
		]);
	}
}