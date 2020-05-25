<?php

namespace Http\Controllers;

use App\Lesson;
use Tests\TestCase;
use Tests\RefreshDatabaseAndMigrate;

class SearchControllerTest extends TestCase {

	use RefreshDatabaseAndMigrate;

	/** @test */
	public function showsTheIndexForm() {
		$this->signIn();

		$response = $this->get('/search');
		$response->assertStatus(200);
		$response->assertViewIs('search.index');
	}

	/** @test */
	public function searchesForLessonAndReturnsResults() {
		$lesson = factory(Lesson::class)->create([
			'name' => 'this is a lesson',
		]);

		$response = $this->get('/search?parameter='. urlencode('this is a'));

		$response->assertSessionHasNoErrors();
		$response->assertStatus(200);
		$response->assertViewIs('search.index');
		$response->assertViewHas('lessons');
	}
}
