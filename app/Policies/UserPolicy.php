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
	 * @return bool
	 */
	public function viewAny(User $user): bool {
		return $user->can('user.index');
	}

	/**
	 * Determine whether the user can view the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\User  $model
	 * @return bool
	 */
	public function view(User $user, User $model): bool {
		return $user->id === $model->id || $user->can('user.view');
	}

	/**
	 * Determine whether the user can create models.
	 *
	 * @param  \App\User  $user
	 * @return bool
	 */
	public function create(User $user): bool {
		return $user->can('user.create');
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\User  $model
	 * @return bool
	 */
	public function update(User $user, User $model): bool {
		return $user->id === $model->id || $user->can('user.update');
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\User  $model
	 * @return bool
	 */
	public function updateAny(User $user, User $model): bool {
		return $user->can('user.update.any');
	}

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\User  $model
	 * @return bool
	 */
	public function updateRole(User $user, User $model): bool {
		return $user->can('user.update.role');
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param  \App\User  $user
	 * @param  \App\User  $model
	 * @return bool
	 */
	public function delete(User $user, User $model): bool {
		return $user->can('user.delete');
	}
}
