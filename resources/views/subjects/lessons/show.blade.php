@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col">
			<div class="card mb-2">
				<div class="card-body">
					<h5 class="card-title">{{ $lesson->name }}</h5>
					<h6 class="card-subtitle mb-2 text-muted">{{ $subject->name }}</h6>
					<p class="card-text">{{ $lesson->description }}</p>
					@if($lesson->show_author)
						<p class="card-text">Lesson Contributed By: {{ $lesson->user->name }}</p>
					@endif
					<p class="card-text">Published: {{ $lesson->published_at->format('d/m/Y H:i') }}</p>
				</div>
			</div>
			<div class="card my-3">
				<div class="card-header">
					Learning Materials
				</div>
				<ul class="list-group">
					@if($lesson->learningMaterials->count())
						@foreach($lesson->learningMaterials as $learningMaterial)
							<li class="list-group-item">
								{{ $learningMaterial->original_name }} - {{ $learningMaterial->size }}Kb
								<a href="{{ route('file-download.show', ['file' => $learningMaterial->file, 'type' => 'learningMaterial' ]) }}" class="btn btn-outline-success btn-sm float-right">
									@auth
										Download
									@endauth
									@guest
										Login to Download Files
									@endguest
								</a>
							</li>
						@endforeach
					@else
						<li class="list-group-item">There are no learning materials for this lesson</li>
					@endif
				</ul>
			</div>
			<div class="card my-3">
				<div class="card-header">
					Worksheets
				</div>
				<ul class="list-group">
				@if($lesson->worksheets->count())
					@foreach($lesson->worksheets as $worksheet)
						<li class="list-group-item">
							{{ $worksheet->original_name }} - {{ $worksheet->size }}Kb
							<a href="{{ route('file-download.show', ['file' => $worksheet->file, 'type' => 'worksheet' ]) }}" class="btn btn-outline-success btn-sm float-right">
								@auth
									Download
								@endauth
								@guest
									Login to Download Files
								@endguest
							</a>
						</li>
					@endforeach
					@else
						<li class="list-group-item">There are no worksheets for this lesson</li>
					@endif
				</ul>
			</div>
		</div>
	</div>
@endsection
