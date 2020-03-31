<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller {

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index(): View {
		$subjects = Subject::all();
		$lessons = Lesson::all()->where('published', true)->random()->take(4)->get();
		return view('home.index', compact('subjects', 'lessons'));
	}
}
