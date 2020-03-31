<?php

namespace App\Http\Requests\Profile\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest {

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
			'worksheets' => 'nullable',
			'learning_materials' => 'nullable',
			'published' => 'required|boolean',
		];
	}
}
