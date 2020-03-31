@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					Personal Details
				</div>
				<div class="card-body">
					<ul class="list-group">
						<li class="list-group-item">
							Name: {{ $user->name }}
						</li>
						<li class="list-group-item">
							Email: {{ $user->email }}
						</li>
						<li class="list-group-item">
							Role: {{ ucfirst($user->roles()->first()->name) }}
						</li>
					</ul>
				</div>
				<div class="card-footer">
					<a href="{{ route('profile.user.edit', ['profile' => $user, 'user' => $user]) }}" class="btn btn-primary float-right">
						Update Details
					</a>
				</div>
			</div>
		</div>
		<div class="col-sm-12 mt-3">
			<div class="card">
				<div class="card-header">
					Your Lessons
				</div>
				<div class="card-body table-responsive">
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
							</tr>
							@foreach($lessons as $lesson)
								<tr>
									<td>{{ $lesson->subject->name }}</td>
									<td>{{ $lesson->name }}</td>
									<td>{{ $lesson->created_at->format('d/m/Y H:i') }}</td>
									<td>{{ $lesson->updated_at->format('d/m/Y H:i') }}</td>
									<td>{{ $lesson->published_at ? $lesson->published_at->format('d/m/Y H:i') : 'Not Yet Published' }}</td>
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
	</div>
@endsection