<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MathematicalMagiciansController extends Controller {

	public function index() {
		return view('games.mathematical-magicians.index');
	}
}
