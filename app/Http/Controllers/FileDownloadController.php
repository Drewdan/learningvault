<?php

namespace App\Http\Controllers;

use App\LearningMaterial;
use App\Worksheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileDownloadController extends Controller {

	public function __construct() {
		return $this->middleware('auth');
	}

	public function show(Request $request) {
		$data = $request->validate(['file' => 'required', 'type' => 'required']);

		if ($data['type'] === 'worksheet') {
			$worksheet = Worksheet::whereFile($data['file'])->firstOrFail();
			return Storage::download($worksheet->file, $worksheet->original_name);
		}

		if ($data['type'] === 'learningMaterial') {
			$learningMaterial = LearningMaterial::whereFile($data['file'])->firstOrFail();
			return Storage::download($learningMaterial->file, $learningMaterial->original_name);
		}
	}
}
