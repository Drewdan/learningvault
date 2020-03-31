<?php

namespace App\Policies;

use App\User;
use App\Subject;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectPolicy {
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any subjects.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function viewAny(User $user) {
		return $user->can('subject.index');
	}

	/**
	 * Determine whether the user can view the subject.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Subject  $subject
	 * @return mixed
 */
	public function view(User $user, Subject $subject) {
		return $user->can('subject.view');
	}

	/**
	 * Determine whether the user can create subjects.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user) {
		return $user->can('subject.create');
	}

	/**
	 * Determine whether the user can update the subject.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Subject  $subject
	 * @return mixed
	 */
	public function update(User $user, Subject $subject) {
		return $user->can('subject.create');
	}

	/**
	 * Determine whether the user can delete the subject.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Subject  $subject
	 * @return mixed
	 */
	public function delete(User $user, Subject $subject) {
		return $user->can('subject.delete');
	}
}
