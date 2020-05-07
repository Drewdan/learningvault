<?php

namespace App\Observers;

use App\Lesson;
use App\Notifications\LessonSubmitted;
use App\User;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Notification;

class LessonObserver {
	/**
	 * Handle the lesson "created" event.
	 *
	 * @param  \App\Lesson  $lesson
	 * @return void
	 */
	public function created(Lesson $lesson): void {
		$users = User::role(['admin', 'moderator'])->get();
		Notification::send($users, new LessonSubmitted($lesson));
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
