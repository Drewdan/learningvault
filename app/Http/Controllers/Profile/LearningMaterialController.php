<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\LearningMaterial;
use App\User;
use Illuminate\Http\Request;

class LearningMaterialController extends Controller {

	// public function __construct() {
	// 	$this->middleware('auth');
	// 	$this->authorizeResource(LearningMaterial::class, 'learning_material');
	// }

	public function destroy(User $profile, LearningMaterial $learningMaterial) {
		$learningMaterial->delete();
		return redirect()->back()->withMessage(__('messages.learning_material.deleted'));
	}
}
