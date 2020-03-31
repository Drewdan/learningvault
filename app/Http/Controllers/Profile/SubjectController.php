<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subject\StoreRequest;
use App\Http\Requests\Subject\UpdateRequest;
use App\Subject;
use App\User;
use Illuminate\Http\Request;

class SubjectController extends Controller {

	public function __construct() {
		$this->middleware('auth');
		$this->authorizeResource(Subject::class, 'subject');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(User $profile) {
		$subjects = Subject::paginate();
		return view('profile.subjects.index', compact('profile', 'subjects'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(User $profile) {
		return view('profile.subjects.create', compact('profile'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreRequest $request, User $profile) {
		Subject::create($request->validated());
		return redirect()->route('profile.subject.index', compact('profile'))->withMessage(__('messages.subject.store'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $profile, Subject $subject) {
		return view('profile.subjects.edit', compact('profile', 'subject'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateRequest $request, User $profile, Subject $subject) {
		$subject->update($request->validated());
		return redirect()->route('profile.subject.index', compact('profile'))->withMessage(__('messages.subject.updated'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $profile, Subject $subject) {
		$subject->delete();
		return redirect()->route('profile.subject.index', compact('profile'))->withMessage(__('messages.subject.deleted'));
	}
}
