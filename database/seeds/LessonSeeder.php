<?php

use App\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		factory(Lesson::class, 100)->create();
	}
}
