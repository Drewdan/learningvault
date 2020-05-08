<?php

namespace Tests\Feature\Http\Controllers\Profile;

use Tests\TestCase;
use Tests\RefreshDatabaseAndMigrate;

class UserControllerTest extends TestCase {

	use RefreshDatabaseAndMigrate;

	public function testIndexRouteAsAdmin() {
		$this->signIn();
		$response = $this->get('/profile/user');
		$response->assertStatus(200);
	}

	public function testIndexRouteAsModerator() {
		$this->signIn('moderator@example.com');
		$response = $this->get('/profile/user');
		$response->assertStatus(200);
	}

	public function testIndexRouteAsUserIsRejected() {
		$this->signIn('user@example.com');
		$response = $this->get('/profile/user');
		$response->assertStatus(403);
	}

	public function testShowAnotherUserAsAgentFails() {
		$user = $this->signIn('user@example.com');
		$response = $this->get('/profile/user/2/edit'); //this is the moderator test account
		$response->assertStatus(403);
	}

	//TODO: add more test methods
}
