<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\User;
use App\Worksheet;
use Illuminate\Http\Request;

class WorksheetController extends Controller {

	public function __construct() {
		$this->middleware('auth');
		$this->authorizeResource(Worksheet::class, 'worksheet');
	}

	public function destroy(User $profile, Worksheet $worksheet) {
		$worksheet->delete();
		return redirect()->back()->withMessage(__('messages.worksheet.deleted'));
	}
}
