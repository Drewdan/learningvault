<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class RegeneratePermissions extends Command {

	use ConfirmableTrait;

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'regenerate:permissions';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Regenerates the permissions';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		if (! $this->confirmToProceed()) {
			return;
		}

		$this->call('cache:clear');

		$this->info('Re-seeding Permissions.');

		Schema::disableForeignKeyConstraints();
		Permission::truncate();
		Schema::enableForeignKeyConstraints();

		Model::unguard();
		$this->call(
			'db:seed',
			[
				'--class' => 'PermissionSeeder',
				'--force' => true,
			]
		);
		Model::reguard();
	}
}
