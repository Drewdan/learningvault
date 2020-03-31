<?php

namespace App\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest {


	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'name' => 'required',
			'description' => 'required',
			'level_id' => 'required|exists:levels,id',
			'show_author' => 'boolean',
			'worksheets' => 'required',
			'learning_materials' => 'required',
		];
	}
}
