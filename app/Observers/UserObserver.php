<?php

namespace App\Observers;

use App\Mail\NewUserMail;
use App\User;
use Illuminate\Support\Facades\Mail;

class UserObserver {
	/**
	 * Handle the user "created" event.
	 *
	 * @param  \App\User  $user
	 * @return void
	 */
	public function created(User $user): void {
		Mail::to($user->email)->send(new NewUserMail($user));
	}

	/**
	 * Handle the user "updated" event.
	 *
	 * @param  \App\User  $user
	 * @return void
	 */
	public function updated(User $user) {
		//
	}

	/**
	 * Handle the user "deleted" event.
	 *
	 * @param  \App\User  $user
	 * @return void
	 */
	public function deleted(User $user) {
		//
	}
}
