<?php

namespace App\Providers;

use App\Lesson;
use App\Observers\LessonObserver;
use App\Subject;
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

		Lesson::observe(LessonObserver::class);
	}
}
