@extends('layouts.app')

@section('content')
	<div class="col-sm-12 mt-3">
		<div class="card">
			<div class="card-header">
				Users
				{{-- <a href="{{ route('profile.user.create') }}" class="btn btn-sm btn-success float-right">Create User</a> --}}
			</div>
			<div class="card-body table-responsive">
				@include('layouts.messages')
				@if(!$users)
					There are no users in the database
				@else
					<table class="table table-condensed table-striped">
						<tr>
							<th>User Name</th>
							<th>Lessons Contributed</th>
							<th>User Role</th>
							<th>Created</th>
							<th>Last Updated</th>
							<th>&nbsp;</th>
						</tr>
						@foreach($users as $user)
							<tr>
								<td>{{ $user->name }}</td>
								<td>{{ $user->lessons()->count() }}</td>
								<td>{{ ucfirst($user->roles()->first()->name) }}</td>
								<td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
								<td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
								<td class="align-middle text-right">
									{{-- <a class="btn btn-success" href="#"><img src="/svg/magnifying-glass.svg" alt="icon name"></a> --}}
									<a class="btn btn-sm btn-primary" href="{{ route('profile.user.edit', compact('user')) }}"><img src="/svg/pencil.svg" alt="icon name"></a>
									<form class="d-inline-block" action="{{ route('profile.user.destroy', compact('user')) }}" method="post">
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
							{{ $users->links() }}
						</div>
					</div>
				@endif
			</div>
			<div class="card-footer">

			</div>
		</div>
	</div>
@endsection
