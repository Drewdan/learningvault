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
	public function index(User $profile) {
		$lessons = Auth::user()->can('lesson.index') ? Lesson::paginate(15) : Lesson::belongsToUser()->paginate(15);
		return view('profile.lessons.index', compact('profile', 'lessons'));
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
	public function edit(User $profile, Lesson $lesson) {
		$subjects = Subject::all();
		$levels = Level::all();
		return view('profile.lessons.edit', compact('profile', 'lesson', 'subjects', 'levels'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateRequest $request, User $profile, Lesson $lesson) {
		$lesson->update($request->validated());
		return redirect()->route('profile.lesson.index', compact('profile'))->withMessage(__('messages.lesson.updated'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $profile, Lesson $lesson) {
		$lesson->delete();
		return redirect()->back()->withMessage(__('messages.lesson.deleted'));
	}
}
