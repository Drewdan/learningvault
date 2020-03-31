@extends('layouts.app')

@section('content')
	<div class="col-sm-12 mt-3">
		<div class="card">
			<div class="card-header">
				Study Levels
				<a href="{{ route('profile.subject.create', compact('profile')) }}" class="btn btn-sm btn-success float-right">Create Subject</a>
			</div>
			<div class="card-body table-responsive">
				@include('layouts.messages')
				@if(!$subjects)
					There are no subjects in the database
				@else
					<table class="table table-condensed table-striped">
						<tr>
							<th>Subject Name</th>
							<th>Lesson Count</th>
							<th>Created</th>
							<th>Last Updated</th>
							<th>&nbsp;</th>
						</tr>
						@foreach($subjects as $subject)
							<tr>
								<td>{{ $subject->name }}</td>
								<td>{{ $subject->lessons()->count() }}</td>
								<td>{{ $subject->created_at->format('d/m/Y H:i') }}</td>
								<td>{{ $subject->updated_at->format('d/m/Y H:i') }}</td>
								<td class="align-middle text-right">
									{{-- <a class="btn btn-success" href="#"><img src="/svg/magnifying-glass.svg" alt="icon name"></a> --}}
									<a class="btn btn-sm btn-primary" href="{{ route('profile.subject.edit', compact('profile', 'subject')) }}"><img src="/svg/pencil.svg" alt="icon name"></a>
									<form class="d-inline-block" action="{{ route('profile.subject.destroy', compact('profile', 'subject')) }}" method="post">
										@csrf()
										@method('DELETE')
										<button class="btn btn-sm btn-danger" href="#"><img src="/svg/trash.svg" alt="icon name"></button>
									</form>
								</td>
							</tr>
						@endforeach
					</table>
					<div class="row">
						<div class="col">
							{{ $subjects->links() }}
						</div>
					</div>
				@endif
			</div>
			<div class="card-footer">

			</div>
		</div>
	</div>
@endsection