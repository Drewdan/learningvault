<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LessonPermissionSeeder extends Seeder {

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
				'name' => 'lesson.index',
				'roles' => [
					$admin,
					$moderator,
					$user,
				],
			]
		);

		/** Create */
		$this->createAndAssign(
			[
				'name' => 'lesson.create',
				'roles' => [
					$admin,
					$moderator,
					$user,
				],
			]
		);

		/** View */
		$this->createAndAssign(
			[
				'name' => 'lesson.view',
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
				'name' => 'lesson.update',
				'roles' => [
					$admin,
					$moderator,
				],
			]
		);

		/** Delete */
		$this->createAndAssign(
			[
				'name' => 'lesson.delete',
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
