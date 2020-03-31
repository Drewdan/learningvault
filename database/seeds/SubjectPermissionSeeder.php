<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SubjectPermissionSeeder extends Seeder {

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
				'name' => 'subject.index',
				'roles' => [
					$admin,
					$moderator,
				],
			]
		);

		/** Create */
		$this->createAndAssign(
			[
				'name' => 'subject.create',
				'roles' => [
					$admin,
					$moderator,
				],
			]
		);

		/** View */
		$this->createAndAssign(
			[
				'name' => 'subject.view',
				'roles' => [
					$admin,
					$moderator,
					$user,
				],
			]
		);

		/** Update */
		$this->createAndAssign(
			[
				'name' => 'subject.update',
				'roles' => [
					$admin,
					$moderator,
				],
			]
		);

		/** Delete */
		$this->createAndAssign(
			[
				'name' => 'subject.delete',
				'roles' => [
					$admin,
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
