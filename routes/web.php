<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('games')->group(function () {
	Route::get('/mathematical-magicians', 'Games\MathematicalMagiciansController@index')->name('games.mathematical-magicians');
});

Route::prefix('profile/')->name('profile.')->group(function () {
	Route::resource('subject', 'Profile\SubjectController');
	Route::resource('lesson', 'Profile\LessonController');
	Route::resource('level', 'Profile\LevelController');
	Route::resource('user', 'Profile\UserController');
	Route::resource('worksheet', 'Profile\WorksheetController')->only('destroy');
	Route::resource('learning-material', 'Profile\LearningMaterialController')->only('destroy');
});

Route::get('/file-download', 'FileDownloadController@show')->name('file-download.show');

Route::resource('level', 'LevelController');
Route::resource('subject', 'SubjectController');
Route::resource('search', 'SearchController')->only('index');
Route::prefix('subject/{subject}')->group(function () {
	Route::resource('lesson', 'LessonController');
});
