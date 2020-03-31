<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$admin = User::create([
			'name' => 'Admin User',
			'email' => 'admin@example.com',
			'password' => Hash::make('123456'),
		]);

		$admin->assignRole('admin');

		$moderator = User::create([
			'name' => 'Moderator User',
			'email' => 'moderator@example.com',
			'password' => Hash::make('123456'),
		]);

		$moderator->assignRole('moderator');

		$user = User::create([
			'name' => 'Standard User',
			'email' => 'user@example.com',
			'password' => Hash::make('123456'),
		]);

		$user->assignRole('user');
	}
}
