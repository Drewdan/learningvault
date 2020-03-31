<?php

namespace App\Policies;

use App\Lesson;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LessonPolicy {
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any lessons.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function viewAny(?User $user): bool {
		return $user->can('lesson.index') || !$user;
	}

	/**
	 * Determine whether the user can view the lesson.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Lesson  $lesson
	 * @return mixed
	 */
	public function view(?User $user, Lesson $lesson): bool {
		return !$user || $user->can('lesson.view');
	}

	/**
	 * Determine whether the user can create lessons.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user): bool {
		return $user->can('lesson.create');
	}

	/**
	 * Determine whether the user can update the lesson.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Lesson  $lesson
	 * @return mixed
	 */
	public function update(User $user, Lesson $lesson): bool {
		return $user->can('lesson.update');
	}

	/**
	 * Determine whether the user can delete the lesson.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Lesson  $lesson
	 * @return mixed
	 */
	public function delete(User $user, Lesson $lesson): bool {
		return $user->can('lesson.delete');
	}
}
