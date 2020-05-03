@extends('layouts.app')

@section('content')
	<div class="row alert alert-info">
		<div class="col-sm-12 col-md-auto ml-auto py-2">
			Have a lesson you would like to share? Anyone can create lessons for Opensource Learning!
		</div>
		<div class="col-sm-12 col-md-auto mr-auto">
			<a href="{{ route('lesson.create', compact('subject')) }}" class="btn btn-primary">Submit a Lesson</a>
		</div>
	</div>
	@include('layouts.messages')
	<div class="row">
		@foreach($lessons as $lesson)
			<div class="col-sm-12 col-md-6 my-2">
				<div class="card">
					<div class="card-header">
						{{ $lesson->name }}
					</div>
					<div class="card-body">
						<p class="card-text">{{ $lesson->description }}</p>
					</div>
					<ul class="list-group list-group-flush">
						@if($lesson->show_author)
							<li class="list-group-item">Created By: {{ $lesson->user->name }}</li>
						@endif
						<li class="list-group-item">Published: {{ $lesson->published_at->diffForHumans() }}</li>
						<li class="list-group-item">Level: {{ $lesson->level->name }}</li>
					</ul>
					<div class="card-footer">
						<a class="btn btn-success" href="{{ route('lesson.show', compact('subject', 'lesson')) }}">View Lesson</a>
						@can('update', $lesson)
							<a class="btn btn-info" href="{{ route('profile.lesson.edit', ['subject' => $subject, 'lesson' => $lesson, 'profile' => Auth::user()]) }}">Edit Lesson</a>
						@endcan
					</div>
				</div>
			</div>
		@endforeach
	</div>
	<div class="row">
		<div class="col">
			{{ $lessons->links() }}
		</div>
	</div>
@endsection