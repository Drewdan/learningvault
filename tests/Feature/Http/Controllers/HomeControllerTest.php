<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeControllerTest extends TestCase {

	use DatabaseTransactions;

	public function testTheDashboardPageLoads() {
		$response = $this->get('/');
		$response->assertStatus(200);
		$response->assertViewHas(['subjects']);
	}
}
