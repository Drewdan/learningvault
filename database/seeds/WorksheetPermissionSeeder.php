<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class WorksheetPermissionSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$admin = Role::whereName('admin')->first();
		$moderator = Role::whereName('moderator')->first();

		/** Delete */
		$this->createAndAssign(
			[
				'name' => 'worksheet.delete',
				'roles' => [
					$admin,
					$moderator,
				],
			]
		);
	}

	/**
	 * Creates the roles and assigns it to the user.
	 *
	 * @param  array $details
	 * @return void
	 */
	protected function createAndAssign(array $details): void {
		$permission = Permission::create(
			[
				'name' => $details['name'],
			]
		);

		foreach ($details['roles'] as $role) {
			$role->givePermissionTo($permission);
		}
	}
}
