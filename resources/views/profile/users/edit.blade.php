@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-sm-12">
			@include('layouts.messages')
			<form method="post" action="{{ route('profile.user.update', compact('user')) }}">
				@csrf
				@method('PATCH')
				<div class="form-group">
					<label>User Name</label>
					<input type="text" name="name" class="form-control" value="{{ $user->name }}">
				</div>
				@can('updateRole', $user)
					<div class="form-group">
						<label>Role</label>
						<select class="form-control" name="role">
							@foreach($roles as $role)
								<option value="{{ $role->name }}"
									@if($user->roles()->first()->name === $role->name)
										selected
									@endif
									>{{ ucfirst($role->name) }}</option>
							@endforeach
						</select>
					</div>
				@endcan
				<div class="form-group">
					<label>Language</label>
					<select class="form-control">
						<option>English</option>
					</select>
				</div>
				<div class="form-group">
					<button class="btn btn-primary form-control">
						Update User
					</button>
				</div>
			</form>
		</div>
	</div>
@endsection
