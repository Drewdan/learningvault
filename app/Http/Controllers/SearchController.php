<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;

class SearchController extends Controller {

	public function index(Request $request) {
		$data = $request->validate(['parameter' => 'nullable']);
		if (isset($data['parameter'])) {
			$lessons = Lesson::where('name', 'like', '%' . $data['parameter'] . '%')
				->orWhere('description', 'like', '%' . $data['parameter'] . '%')
				->paginate(10);
		}

		return view('search.index', [
			'lessons' => $lessons ?? null,
		]);
	}
}
