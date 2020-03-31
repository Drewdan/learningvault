<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Level\StoreRequest;
use App\Http\Requests\Level\UpdateRequest;
use App\Level;
use App\User;
use Illuminate\Http\Request;

class LevelController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(User $profile) {
		$levels = Level::paginate(15);
		return view('profile.levels.index', compact('profile', 'levels'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(User $profile) {
		return view('profile.levels.create', compact('profile'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreRequest $request, User $profile) {
		Level::create($request->validated());
		return redirect()->route('profile.level.index', compact('profile'))->withMessage(__('messages.level.store'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $profile, Level $level) {
		return view('profile.levels.edit', compact('profile', 'level'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateRequest $request, User $profile, Level $level) {
		$level->update($request->validated());
		return redirect()->route('profile.level.index', compact('profile'))->withMessage(__('messages.level.updated'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $profile, Level $level) {
		$level->delete();
		return redirect()->route('profile.level.index', compact('profile'))->withMessage(__('messages.level.deleted'));
	}
}
