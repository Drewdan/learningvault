<?php

namespace App\Providers;

use App\Lesson;
use App\Observers\LessonObserver;
use App\Observers\UserObserver;
use App\Subject;
use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		Schema::defaultStringLength(191);
		if (!app()->runningInConsole()) {
			View::share('subjects', Subject::all() ?? null);
		} else {
			View::share('subjects', []);
		}

		//Register the application observers
		Lesson::observe(LessonObserver::class);
		User::observe(UserObserver::class);
	}
}
