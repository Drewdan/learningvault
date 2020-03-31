@extends('layouts.app')

@section('content')
	<div class="col-sm-12 mt-3">
		<div class="card">
			<div class="card-header">
				Study Levels
				<a href="{{ route('profile.level.create', compact('profile')) }}" class="btn btn-sm btn-success float-right">Create Level</a>
			</div>
			<div class="card-body table-responsive">
				@include('layouts.messages')
				@if(!$levels)
					There are no levels in the database
				@else
					<table class="table table-condensed table-striped">
						<tr>
							<th>Level Name</th>
							<th>Lesson Count</th>
							<th>Created</th>
							<th>Last Updated</th>
							<th>&nbsp;</th>
						</tr>
						@foreach($levels as $level)
							<tr>
								<td>{{ $level->name }}</td>
								<td>{{ $level->lessons()->count() }}</td>
								<td>{{ $level->created_at->format('d/m/Y H:i') }}</td>
								<td>{{ $level->updated_at->format('d/m/Y H:i') }}</td>
								<td class="align-middle text-right">
									{{-- <a class="btn btn-success" href="#"><img src="/svg/magnifying-glass.svg" alt="icon name"></a> --}}
									<a class="btn btn-sm btn-primary" href="{{ route('profile.level.edit', compact('profile', 'level')) }}"><img src="/svg/pencil.svg" alt="icon name"></a>
									<form class="d-inline-block" action="{{ route('profile.level.destroy', compact('profile', 'level')) }}" method="post">
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
							{{ $levels->links() }}
						</div>
					</div>
				@endif
			</div>
			<div class="card-footer">

			</div>
		</div>
	</div>
@endsection