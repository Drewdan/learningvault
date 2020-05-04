<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lesson\StoreRequest;
use App\Http\Requests\Lesson\UpdateRequest;
use App\Lesson;
use App\Level;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LessonController extends Controller {

	public function __construct() {
		$this->middleware('auth')->except('show', 'index');
		$this->authorizeResource(Lesson::class, 'lesson');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index(Subject $subject): View {
		$lessons = $subject->lessons()->published()->paginate(10);
		return view('subjects.lessons.index', compact('subject', 'lessons'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Subject $subject) {
		$levels = Level::all();
		return view('subjects.lessons.create', compact('subject', 'levels'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreRequest $request, Subject $subject) {
		$data = $request->validated();

		$lesson = $subject->lessons()->make($data);
		$lesson->user()->associate(Auth::user());
		$lesson->save();

		if (isset($data['worksheets'])) {
			foreach ($data['worksheets'] as $worksheet) {
				$file = $worksheet->store('files');
				$lesson->worksheets()->create([
					'file' => $file,
					'original_name' => $worksheet->getClientOriginalName(),
				]);
			}
		}

		if (isset($data['learning_materials'])) {
			foreach ($data['learning_materials'] as $material) {
				$file = $material->store('files');
				$lesson->learningMaterials()->create([
					'file' => $file,
					'original_name' => $material->getClientOriginalName(),
				]);
			}
		}

		return redirect()->route('lesson.index', compact('subject'))->withMessage(__('messages.lesson.store'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Lesson  $lesson
	 * @return \Illuminate\View\View
	 */
	public function show(Subject $subject, Lesson $lesson): View {
		return view('subjects.lessons.show', compact('subject', 'lesson'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Lesson  $lesson
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Subject $subject, Lesson $lesson) {
		return view('subjects.lessons.edit', compact('subject', 'lesson'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Lesson  $lesson
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateRequest $request, Subject $subject, Lesson $lesson) {
		$data = $request->validated();

		$lesson->update($data);

		foreach ($data['worksheets'] as $worksheet) {
			$file = $worksheet->store('files');
			$lesson->worksheets()->create([
				'file' => $file,
				'original_name' => $worksheet->getClientOriginalName(),
			]);
		}

		foreach ($data['learning_materials'] as $material) {
			$file = $material->store('files');
			$foo = $lesson->learningMaterials()->create([
				'file' => $file,
				'original_name' => $material->getClientOriginalName(),
			]);
		}

		return redirect()->route('lesson.index', compact('subject'))->withMessage(__('messages.lesson.updated'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Lesson  $lesson
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Subject $subject, Lesson $lesson) {
		$lesson->delete();

		return redirect()->route('lesson.index', compact('subject'))->withMessage(__('messages.lesson.deleted'));
	}
}
