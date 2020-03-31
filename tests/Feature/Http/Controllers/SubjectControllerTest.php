<?php

namespace Tests\Feature\Http\Controllers;

use App\Subject;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class SubjectControllerTest extends TestCase {

	use DatabaseTransactions, WithFaker;

	public function testTheIndexPageLoads() {
		$this->signIn();
		$response = $this->get('/subject');
		$response->assertStatus(200);
		$response->assertViewHas(['subjects']);
	}

	public function testTheCreatePageLoads() {
		$this->signIn();
		$response = $this->get('/subject/create');
		$response->assertStatus(200);
		$response->assertViewIs('subjects.create');
	}

	public function testTheCreatePageDoesNotLoadForUnauthenticatedUsers() {
		$response = $this->get('/subject/create');
		$response->assertStatus(302);
		$response->assertRedirect('/login');
	}

	public function testTheUserCanStoreSubject() {
		$this->signIn();
		$subjectName = $this->faker->sentence;
		$subjectSlug = Str::slug($subjectName);

		$response = $this->post('/subject', [
			'name' => $subjectName,
		]);

		$response->assertStatus(302);
		$this->assertDatabaseHas('subjects', [
			'name' => $subjectName,
			'slug' => $subjectSlug,
			'published' => 1,
		]);
		$response->assertRedirect('/subject');
	}

	public function testTheEditFormLoads() {
		$this->signIn();

		$subject = factory(Subject::class)->create();

		$response = $this->get('/subject/' . $subject->slug . '/edit');

		$response->assertStatus(200);
		$response->assertViewIs('subjects.edit');
	}

	public function testTheUserCanUpdateSubject() {
		$this->signIn();
		$subject = factory(Subject::class)->create();
		$subjectName = $this->faker->sentence;
		$subjectSlug = Str::slug($subjectName);

		$response = $this->patch('/subject/' . $subject->slug, [
			'name' => $subjectName,
			'published' => true,
		]);

		$response->assertStatus(302);
		$this->assertDatabaseHas('subjects', [
			'name' => $subjectName,
			'slug' => $subjectSlug,
			'published' => true,
		]);
	}

	public function testTheUserCanDeleteASubject() {
		$this->signIn();
		$subject = factory(Subject::class)->create();

		$response = $this->delete('/subject/' . $subject->slug);
		$response->assertStatus(302);
		$this->assertDatabaseMissing('subjects', ['id' => $subject->id]);
		$response->assertRedirect('/subject');
	}
}
