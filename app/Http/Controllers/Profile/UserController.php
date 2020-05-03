<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller {

	public function __construct() {
		$this->middleware('auth');
		$this->authorizeResource(User::class, 'user');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(User $profile) {
		$users = User::paginate();
		return view('profile.users.index', compact('profile', 'users'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $profile, User $user) {
		$lessons = $user->lessons ? $user->lessons()->paginate(15) : null;
		return view('profile.users.show', compact('user', 'lessons'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $profile, User $user) {
		$roles = Role::all();
		return view('profile.users.edit', compact('profile', 'user', 'roles'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateRequest $request, User $profile, User $user) {
		$data = $request->validated();
		$user->update($data);
		if ($profile->can('updateRole', $user)) {
			$user->syncRoles([$data['role']]);
		}

		if ($profile->can('updateAny', $user)) {
			return redirect()->route('profile.user.index', compact('profile'))->withMessage(__('messages.user.updated'));
		}

		return redirect()->route('profile.user.show', compact('profile', 'user'))->withMessage(__('messages.user.updated'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $profile, User $user) {
		$user->delete();
		return redirect()->route('profile.user.index', compact('profile'))->withMessage(__('messages.user.deleted'));
	}
}
