<?php

namespace App\Http\Controllers;

use App\Http\Requests\Level\StoreRequest;
use App\Http\Requests\Level\UpdateRequest;
use App\Level;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LevelController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index(): View {
		$levels = Level::all();
		return view('levels.index', compact('levels'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create(): View {
		return view('levels.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\Level\StoreRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(StoreRequest $request): RedirectResponse {
		$data = $request->validated();

		Level::create($data);

		return redirect()->route('level.index')->withMessage(__('messages.level.store'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Level  $level
	 * @return \Illuminate\View\View
	 */
	public function show(Level $level): View {
		return view('levels.show', compact('level'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Level  $level
	 * @return \Illuminate\View\View
	 */
	public function edit(Level $level): View {
		return view('levels.edit', compact('level'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\Level\UpdateRequest $request
	 * @param  \App\Level                             $level
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(UpdateRequest $request, Level $level): RedirectResponse {
		$data = $request->validated();

		$level->update($data);

		return redirect()->route('level.index')->withMessage(__('messages.level.updated'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Level $level
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy(Level $level): RedirectResponse {
		$level->delete();

		return redirect()->route('level.index')->withMessage(__('messages.level.deleted'));
	}
}
