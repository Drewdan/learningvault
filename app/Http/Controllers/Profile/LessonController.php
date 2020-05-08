<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\Lesson\UpdateRequest;
use App\Lesson;
use App\Level;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller {

	public function __construct() {
		$this->middleware('auth');
		$this->authorizeResource(Lesson::class, 'lesson');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$lessons = Auth::user()->hasRole(['admin', 'moderator']) ? Lesson::orderBy('published_at', 'asc')->paginate(15) : Lesson::belongsToUser()->paginate(15);
		return view('profile.lessons.index', [
			'lessons' => $lessons,
			'unpublished' => Lesson::unpublished()->get()->count(),
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Lesson $lesson) {
		$subjects = Subject::all();
		$levels = Level::all();
		return view('profile.lessons.edit', compact('lesson', 'subjects', 'levels'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateRequest $request, Lesson $lesson) {
		$lesson->update($request->validated());
		if (Auth::user()->cannot('publishAny', $lesson)) {
			$lesson->update(['published' => false]);
		}
		return redirect()->route('profile.lesson.index')->withMessage(__('messages.lesson.updated'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Lesson $lesson) {
		$lesson->delete();
		return redirect()->back()->withMessage(__('messages.lesson.deleted'));
	}
}
