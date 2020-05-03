@extends('layouts.app')

@section('content')
	<div class="col-sm-12 mt-3">
		<div class="card">
			<div class="card-header">
				Your Lessons
			</div>
			<div class="card-body table-responsive">
				@include('layouts.messages')
				@can('publishAny', App\Lesson::class)
					@if($unpublished !== 0)
						<div class="alert alert-info">
							{{ trans_choice('notices.unpublished-lesson-notification', $unpublished, ['count' => $unpublished]) }}
						</div>
					@endif
				@endcan
				@if(!$lessons)
					You have not contributed any lessons to open source learning...why not start now?
				@else
					<table class="table table-condensed table-striped">
						<tr>
							<th>Lessons Subject</th>
							<th>Lesson Name</th>
							<th>Created</th>
							<th>Last Updated</th>
							<th>Published</th>
							<th>&nbsp;</th>
						</tr>
						@foreach($lessons as $lesson)
							<tr>
								<td>{{ $lesson->subject->name }}</td>
								<td>{{ $lesson->name }}</td>
								<td>{{ $lesson->created_at->format('d/m/Y H:i') }}</td>
								<td>{{ $lesson->updated_at->format('d/m/Y H:i') }}</td>
								<td>{{ $lesson->published_at ? $lesson->published_at->format('d/m/Y H:i') : 'Not Yet Published' }}</td>
								<td class="align-middle text-right">
									{{-- <a class="btn btn-success" href="#"><img src="/svg/magnifying-glass.svg" alt="icon name"></a> --}}
									<a class="btn btn-primary" href="{{ route('profile.lesson.edit', compact('profile', 'lesson')) }}"><img src="/svg/pencil.svg" alt="icon name"></a>
									<form class="d-inline-block" action="{{ route('profile.lesson.destroy', compact('profile', 'lesson')) }}" method="post">
										@csrf()
										@method('DELETE')
										<button class="btn btn-danger" href="#"><img src="/svg/trash.svg" alt="icon name"></button>
									</form>
								</td>
							</tr>
						@endforeach
					</table>
					<div class="row">
						<div class="col">
							{{ $lessons->links() }}
						</div>
					</div>
				@endif
			</div>
			<div class="card-footer">

			</div>
		</div>
	</div>
@endsection