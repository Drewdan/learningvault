<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subject\StoreRequest;
use App\Http\Requests\Subject\UpdateRequest;
use App\Subject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubjectController extends Controller {

	public function __construct() {
		$this->middleware('auth')->except(['index', 'show']);
		$this->authorizeResource(Subject::class, 'subject');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index(): View {
		$subjects = Subject::all();
		return view('subjects.index', compact('subjects'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(): View {
		return view('subjects.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\Subject\StoreRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(StoreRequest $request): RedirectResponse {
		$data = $request->validated();

		Subject::create($data);

		return redirect()->route('subject.index')->withMessage(__('messages.subject.store'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Subject $subject
	 * @return \Illuminate\View\View
	 */
	public function show(Subject $subject): View {
		return view('subjects.show', compact('subject'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Subject $subject
	 * @return \Illuminate\View\View
	 */
	public function edit(Subject $subject): View {
		return view('subjects.edit', compact('subject'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\Subject\UpdateRequest $request
	 * @param  \App\Subject                             $subject
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(UpdateRequest $request, Subject $subject): RedirectResponse {
		$data = $request->validated();

		$subject->update($data);

		return redirect()->route('subject.index')->withMessage(__('messages.subject.update'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Subject $subject
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy(Subject $subject): RedirectResponse {
		$subject->delete();

		return redirect()->route('subject.index')->withMessage(__('messages.subject.deleted'));
	}
}
