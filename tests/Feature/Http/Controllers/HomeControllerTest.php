<?php

namespace Tests\Feature\Http\Controllers;

use App\Subject;
use Tests\TestCase;
use Tests\RefreshDatabaseAndMigrate;

class HomeControllerTest extends TestCase {

	use RefreshDatabaseAndMigrate;

	public function testTheDashboardPageLoads() {
		factory(Subject::class)->create();
		$response = $this->get('/');
		$response->assertStatus(200);
		$response->assertViewHas(['subjects']);
	}
}
