<?php

namespace App\Observers;

use App\Lesson;
use Illuminate\Support\Facades\Date;

class LessonObserver {
	/**
	 * Handle the lesson "created" event.
	 *
	 * @param  \App\Lesson  $lesson
	 * @return void
	 */
	public function created(Lesson $lesson): void {
		//
	}

	/**
	 * Handle the lesson "updated" event.
	 *
	 * @param  \App\Lesson  $lesson
	 * @return void
	 */
	public function updating(Lesson $lesson): void {
		if ($lesson->isDirty('published')) {
			$lesson->published_at = $lesson->published ? Date::now() : null;
		}
	}

	/**
	 * Handle the lesson "deleted" event.
	 *
	 * @param  \App\Lesson  $lesson
	 * @return void
	 */
	public function deleted(Lesson $lesson): void {
		//
	}
}
