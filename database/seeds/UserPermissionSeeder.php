<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserPermissionSeeder extends Seeder {

   /**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$admin = Role::whereName('admin')->first();
		$moderator = Role::whereName('moderator')->first();
		$user = Role::whereName('user')->first();

		/** Index */
		$this->createAndAssign(
			[
				'name' => 'user.index',
				'roles' => [
					$admin,
					$moderator,
				],
			]
		);

		/** Create */
		$this->createAndAssign(
			[
				'name' => 'user.create',
				'roles' => [
					$admin,
				],
			]
		);

		/** View */
		$this->createAndAssign(
			[
				'name' => 'user.view',
				'roles' => [
					$admin,
					$moderator,
				],
			]
		);

		/** Update */
		$this->createAndAssign(
			[
				'name' => 'user.update',
				'roles' => [
					$admin,
					$moderator,
				],
			]
		);

		/** Delete */
		$this->createAndAssign(
			[
				'name' => 'user.delete',
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
