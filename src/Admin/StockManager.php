<?php

namespace Tnt\Ecommerce\Admin;

use dry\admin\component\StringEdit;
use dry\admin\component\StringView;
use dry\orm\action\Create;
use dry\orm\action\Delete;
use dry\orm\action\Edit;
use dry\orm\Index;
use dry\orm\Manager;
use Tnt\Ecommerce\Model\Stock;

class StockManager extends Manager
{
	public function __construct()
	{
		parent::__construct(Stock::class, [
			'icon' => self::ICON_STATS,
			'singular' => 'stock',
		]);

		$this->actions[] = $create = new Create([
			new StringEdit('title', [
				'v8n_required' => TRUE,
			]),
			new StringEdit('hid', [
				'v8n_required' => TRUE,
			]),
		], [
			'mode' => Create::MODE_POPUP,
		]);

		$this->actions[] = $edit = new Edit($create->components, [
			'mode' => Create::MODE_POPUP,
		]);

		$this->actions[] = $delete = new Delete();

		$this->header[] = $create->create_link('Add stock');

		$this->index = new Index([
			new StringView('title'),
			new StringView('hid'),
			$edit->create_link(),
			$delete->create_link(),
		]);
	}
}