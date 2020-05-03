<?php

namespace Tests\Feature\Http\Controllers;

use App\Lesson;
use App\Subject;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\RefreshDatabaseAndMigrate;
use Tests\TestCase;

class LessonControllerTest extends TestCase {

	use RefreshDatabaseAndMigrate, WithFaker;

	protected $subject;

	public function setUp(): void {
		parent::setUp();
		$this->signIn();
		$this->subject = factory(Subject::class)->create();
	}

	public function testShowsTheLessonIndexRouteForASubject() {
		$response = $this->get('/subject/' . $this->subject->slug . '/lesson');
		$response->assertStatus(200);
		$response->assertViewIs('subjects.lessons.index');
	}

	public function testShowsTheCreateForm() {
		$response = $this->get('/subject/' . $this->subject->slug . '/lesson/create');
		$response->assertStatus(200);
		$response->assertViewHas(['subject', 'levels']);
		$response->assertViewIs('subjects.lessons.create');
	}

	public function testStoresLesson() {
		Storage::fake('local');
		$lessonData = [
			'name' => $this->faker->word,
			'description' => $this->faker->sentence,
			'level_id' => 1,
			'show_author' => 1,
		];

		$worksheet1 = UploadedFile::fake()->create('worksheet1.txt', 100);
		$worksheet2 = UploadedFile::fake()->create('worksheet2.txt', 100);

		$learningMaterial1 = UploadedFile::fake()->create('learning1.txt', 100);
		$learningMaterial2 = UploadedFile::fake()->create('learning2.txt', 100);

		$worksheets = [
			'worksheets' => [
				$worksheet1,
				$worksheet2,
			],
		];
		$learningMaterials = [
			'learning_materials' => [
				$learningMaterial1,
				$learningMaterial2,
			],
		];

		$data = array_merge($lessonData, $worksheets, $learningMaterials);

		$response = $this->post('/subject/' . $this->subject->slug . '/lesson', $data);

		$this->assertDatabaseHas('lessons', $lessonData);

		$this->assertDatabaseHas('learning_materials', [
			'original_name' => 'learning1.txt',
		]);

		$this->assertDatabaseHas('learning_materials', [
			'original_name' => 'learning2.txt',
		]);

		$this->assertDatabaseHas('worksheets', [
			'original_name' => 'worksheet1.txt',
		]);

		$this->assertDatabaseHas('worksheets', [
			'original_name' => 'worksheet2.txt',
		]);

		Storage::disk('local')->assertExists('files/' . $learningMaterial1->hashName());
		Storage::disk('local')->assertExists('files/' . $learningMaterial2->hashName());
		Storage::disk('local')->assertExists('files/' . $worksheet1->hashName());
		Storage::disk('local')->assertExists('files/' . $worksheet2->hashName());

		//assert the files in the file system
		//
		//assert the files in the worksheet and learning material table

		$response->assertStatus(302);
		$response->assertRedirect('/subject/' . $this->subject->slug . '/lesson');
	}

	public function testAddingALessonWithoutSupportMaterial() {
		$lessonData = [
			'name' => $this->faker->word,
			'description' => $this->faker->sentence,
			'level_id' => 1,
			'show_author' => 1,
		];

		$response = $this->post('/subject/' . $this->subject->slug . '/lesson', $lessonData);

		$this->assertDatabaseHas('lessons', $lessonData);

		$response->assertStatus(302);
		$response->assertRedirect('/subject/' . $this->subject->slug . '/lesson');
	}

	public function testShowingALesson() {
		$lesson = factory(Lesson::class)->create();
		$response = $this->get('/subject/' . $this->subject->slug . '/lesson/' . $lesson->slug);
		$response->assertStatus(200);
		$response->assertViewIs('subjects.lessons.show');
		$response->assertViewHas(['subject', 'lesson']);
	}

	public function testShowsTheEditFormForALesson() {
		$lesson = factory(Lesson::class)->create();
		$response = $this->get('/subject/' . $this->subject->slug . '/lesson/' . $lesson->slug . '/edit');
		$response->assertStatus(200);
		$response->assertViewIs('subjects.lessons.edit');
		$response->assertViewHas(['subject', 'lesson']);
	}

	public function testUpdatesTheLesson() {
		$lesson = factory(Lesson::class)->create();
		Storage::fake('local');
		$lessonData = [
			'name' => $this->faker->word,
			'description' => $this->faker->sentence,
			'level_id' => 1,
			'show_author' => 1,
		];
		$worksheet3 = UploadedFile::fake()->create('worksheet3.txt', 100);
		$worksheet4 = UploadedFile::fake()->create('worksheet4.txt', 100);

		$learningMaterial3 = UploadedFile::fake()->create('learning3.txt', 100);
		$learningMaterial4 = UploadedFile::fake()->create('learning4.txt', 100);

		$worksheets = [
			'worksheets' => [
				$worksheet3,
				$worksheet4,
			],
		];
		$learningMaterials = [
			'learning_materials' => [
				$learningMaterial3,
				$learningMaterial4,
			],
		];

		$data = array_merge($lessonData, $worksheets, $learningMaterials);

		$response = $this->patch('/subject/' . $this->subject->slug . '/lesson/' . $lesson->slug, $data);

		$this->assertDatabaseHas('lessons', $lessonData);

		$this->assertDatabaseHas('learning_materials', [
			'original_name' => 'learning3.txt',
		]);

		$this->assertDatabaseHas('learning_materials', [
			'original_name' => 'learning4.txt',
		]);

		$this->assertDatabaseHas('worksheets', [
			'original_name' => 'worksheet3.txt',
		]);

		$this->assertDatabaseHas('worksheets', [
			'original_name' => 'worksheet4.txt',
		]);

		Storage::disk('local')->assertExists('files/' . $learningMaterial3->hashName());
		Storage::disk('local')->assertExists('files/' . $learningMaterial4->hashName());
		Storage::disk('local')->assertExists('files/' . $worksheet3->hashName());
		Storage::disk('local')->assertExists('files/' . $worksheet4->hashName());

		$response->assertStatus(302);
		$response->assertRedirect('/subject/' . $this->subject->slug . '/lesson');
	}

	public function testDeletesTheLesson() {
		$lesson = factory(Lesson::class)->create();
		$response = $this->delete('/subject/' . $this->subject->slug . '/lesson/' . $lesson->slug);

		$response->assertStatus(302);
		$response->assertRedirect('/subject/' . $this->subject->slug . '/lesson');

		$this->assertDatabaseMissing('lessons', ['id' => $lesson->id]);
	}
}
