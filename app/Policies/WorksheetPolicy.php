<?php

namespace App\Policies;

use App\User;
use App\Worksheet;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorksheetPolicy {
	use HandlesAuthorization;

	public function delete(User $user, Worksheet $worksheet): bool {
		return $user->can('worksheet.delete');
	}
}
