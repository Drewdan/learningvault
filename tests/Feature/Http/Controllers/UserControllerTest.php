<?php

namespace Tests\Feature\Http\Controllers;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase {

	use DatabaseTransactions, WithFaker;

	public function setUp(): void {
		parent::setUp();
		$this->signIn();
	}

	public function testTheIndexRoute() {
		$response = $this->get('/user');

		$response->assertStatus(200);
		$response->assertViewIs('users.index');
		$response->assertViewHas('users');
	}

	public function testTheShowRoute() {
		$user = factory(User::class)->create();

		$response = $this->get('/user/' . $user->id);
		$response->assertViewIs('users.show');
		$response->assertViewHas('user');
	}

	public function testTheCreateRouteIsInaccesible() {
		$response = $this->get('/user/create');
		$response->assertStatus(404);
	}

	public function testTheStoreRouteIsInaccesible() {
		$response = $this->post('/user');
		$response->assertStatus(405);
	}

	public function testTheEditRoute() {
		$user = factory(User::class)->create();
		$response = $this->get('/user/' . $user->id . '/edit');
		$response->assertStatus(200);
		$response->assertViewIs('users.edit');
		$response->assertViewHas('user');
	}

	public function testTheUpdateRoute() {
		$user = factory(User::class)->create();
		$userData = [
			'name' => $this->faker->name,
		];

		$rolePermission = [
			'role' => 'moderator',
		];

		$data = array_merge($userData, $rolePermission);

		$response = $this->patch('/user/' . $user->id, $data);
		$response->assertStatus(302);
		$response->assertRedirect('/user');

		$userData['id'] = $user->id;

		$this->assertDatabaseHas('users', $userData);
	}

	public function testTheDeleteRoute() {
		$user = factory(user::class)->create();

		$response = $this->delete('/user/' . $user->id);
		$response->assertStatus(302);
		$response->assertRedirect('/user');
		$this->assertDatabaseMissing('users', ['id' => $user->id]);
	}
}
