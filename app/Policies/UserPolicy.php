<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy {
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any models.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function viewAny(User $user): bool {
		return $user->can('user.index');
	}

	/**
	 * Determine whether the user can view the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\User  $model
	 * @return mixed
	 */
	public function view(User $user, User $model): bool {
		return $user->id === $model->id || $user->can('user.view');
	}

	/**
	 * Determine whether the user can create models.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user): bool {
		return $user->can('user.create');
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\User  $model
	 * @return mixed
	 */
	public function update(User $user, User $model): bool {
		return $user->can('user.update');
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\User  $model
	 * @return mixed
	 */
	public function delete(User $user, User $model): bool {
		return $user->can('user.delete');
	}
}
