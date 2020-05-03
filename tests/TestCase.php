<?php

namespace Tests;

use App\User;
use Tests\RefreshDatabaseAndMigrate;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase {
	use CreatesApplication;

	protected $admin = 'admin@example.com';

	protected $moderator = 'moderator@example.com';

	protected $user = 'user@example.com';

	public function setUp(): void {
		parent::setUp();
		$uses = array_flip(class_uses_recursive(static::class));
		if (isset($uses[RefreshDatabaseAndMigrate::class])) {
			$this->refreshDatabase();
		}
	}

	/**
	 * Gets the user model
	 *
	 * @param  string|null $user
	 * @return \App\User
	 */
	public function getUser(string $email = 'admin@example.com'): User {
		$email = $email ?? $this->admin;

		return User::whereEmail($email)->first();
	}

	/**
	 * Determines which user to sign in for Testing - if 'noauth' is passed, no user will be signed in
	 *
	 * @param  mixed $user
	 * @return mixed
	 */
	protected function signIn($user = null) {
		// If it's null use the accountholder email
		$user = $user ?? $this->admin;

		switch ($user) {
			case $user instanceof User:
				$user = $user;
				break;
			case is_integer($user):
				$user = User::find($user);
				break;
			case is_string($user):
				$user = $this->getUser($user);
				break;
		}

		$this->actingAs($user);
		$this->currentUser = $user;

		return $user;
	}
}
