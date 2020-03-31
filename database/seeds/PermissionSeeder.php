<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		Role::firstOrCreate(['name' => 'admin']);
		Role::firstOrCreate(['name' => 'moderator']);
		Role::firstOrCreate(['name' => 'user']);
		//create some roles
		//
		$this->call(
			[
				LevelPermissionSeeder::class,
				LessonPermissionSeeder::class,
				SubjectPermissionSeeder::class,
				UserPermissionSeeder::class,
				WorksheetPermissionSeeder::class,
				LearningMaterialPermissionSeeder::class,
			]
		);
	}
}
