<?php

namespace Tests\Feature\Http\Controllers;

use App\Level;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LevelControllerTest extends TestCase {

	use DatabaseTransactions, WithFaker;

	public function setUp(): void {
		parent::setUp();
		$this->signIn();
	}

	public function testTheLevelIndexRoute() {
		$response = $this->get('/level');

		$response->assertStatus(200);
		$response->assertViewHas('levels');
		$response->assertViewIs('levels.index');
	}

	public function testTheCreateRoute() {
		$response = $this->get('/level/create');

		$response->assertStatus(200);
		$response->assertViewIs('levels.create');
	}

	public function testTheStoreRoute() {
		$data = [
			'name' => $this->faker->word,
			'description' => $this->faker->sentence,
		];

		$response = $this->post('/level', $data);

		$response->assertStatus(302);
		$this->assertDatabaseHas('levels', $data);
		$response->assertRedirect('/level');
	}

	public function testTheShowRoute() {
		$level = factory(Level::class)->create();

		$response = $this->get('/level/' . $level->slug);
		$response->assertStatus(200);
		$response->assertViewHas('level');
		$response->assertViewIs('levels.show');
	}

	public function testTheEditRoute() {
		$level = factory(Level::class)->create();

		$response = $this->get('/level/' . $level->slug . '/edit');
		$response->assertStatus(200);
		$response->assertViewHas('level');
		$response->assertViewIs('levels.edit');
	}

	public function testTheUpdateRoute() {
		$level = factory(Level::class)->create();

		$data = [
			'name' => $this->faker->word,
			'description' => $this->faker->sentence,
		];

		$response = $this->patch('/level/' . $level->slug, $data);
		$response->assertStatus(302);
		$this->assertDatabaseHas('levels', $data);
		$response->assertRedirect('/level');
	}

	public function testTheDeleteRoute() {
		$level = factory(Level::class)->create();

		$response = $this->delete('/level/' . $level->slug);
		$response->assertStatus(302);
		$this->assertDatabaseMissing('levels', ['id' => $level->id]);
		$response->assertRedirect('/level');
	}
}
