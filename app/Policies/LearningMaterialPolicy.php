<?php

namespace App\Policies;

use App\LearningMaterial;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LearningMaterialPolicy {
	use HandlesAuthorization;

	public function delete(User $user, LearningMaterial $learningMaterial): bool {
		return $user->can('learning-material.delete');
	}
}
