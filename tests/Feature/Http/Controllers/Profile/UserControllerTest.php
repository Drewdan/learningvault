<?php

namespace Tests\Feature\Http\Controllers\Profile;

use Tests\TestCase;
use Tests\RefreshDatabaseAndMigrate;

class UserControllerTest extends TestCase {

	use RefreshDatabaseAndMigrate;

	public function testIndexRouteAsAdmin() {
		$user = $this->signIn();
		$response = $this->get('/profile/' . $user->id . '/user');
		$response->assertStatus(200);
	}

	public function testIndexRouteAsModerator() {
		$user = $this->signIn('moderator@example.com');
		$response = $this->get('/profile/' . $user->id . '/user');
		$response->assertStatus(200);
	}

	public function testIndexRouteAsUserIsRejected() {
		$user = $this->signIn('user@example.com');
		$response = $this->get('/profile/' . $user->id . '/user');
		$response->assertStatus(403);
	}

	//TODO: add more test methods
}
