@extends('layouts.app')

@section('jumbotron')
	<div class="jumbotron p-3 p-md-5 text-white rounded bg-children-image">
		<div class="col-sm-12 col-md-8 px-0">
			<h1 class="display-4 font-italic">Community driven learning resources for children</h1>
			<p class="lead my-3">Open source learning is a hub for material to engage children when they are studying at home. Be it home schooled children, children missing school due to sickness, or any other reason.</p>
			<p class="lead my-3">Not being in school should not mean you miss out, and learning need not be expensive. All of the materials on this website are free to download and redistribute as you wish.</p>
			{{-- <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p> --}}
		</div>
	</div>

	<div class="row mb-2">
		@foreach($lessons as $lesson)
			<div class="col-md-6">
				<div class="card flex-md-row mb-4 box-shadow h-md-250">
					<div class="card-body d-flex flex-column align-items-start">
						<strong class="d-inline-block mb-2 text-primary">{{ $lesson->subject->name }}</strong>
						<h3 class="mb-0">
						<a class="text-dark" href="{{ route('lesson.show', ['subject' => $lesson->subject, 'lesson' => $lesson]) }}">{{ $lesson->name }}</a>
						</h3>
						<div class="mb-1 text-muted">{{ $lesson->published_at->format('d/m/Y') }}</div>
							<p class="card-text">{{ $lesson->description }}</p>
							@if($lesson->show_author)
								<p class="card-text mb-auto">Contributed By: {{ $lesson->user->name }}</p>
							@endif
							<a href="{{ route('lesson.show', ['subject' => $lesson->subject, 'lesson' => $lesson]) }}">View Lesson</a>
					</div>
				</div>
			</div>
		@endforeach
	</div>
@endsection

@section('content')
	<div class="row">
		
	</div>
@endsection