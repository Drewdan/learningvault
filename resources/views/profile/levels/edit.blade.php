@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<form method="post" action="{{ route('profile.level.update', compact('profile', 'level')) }}">
				@csrf
				@method('PATCH')
				<div class="form-group">
					<label>Level Name</label>
					<input type="text" name="name" class="form-control" value="{{ $level->name ?? old('name') }}">
				</div>
				<div class="form-group">
					<label>Level Description</label>
					<textarea name="description" class="form-control">{{ $level->description ?? old('description') }}</textarea>
				</div>
				<div class="form-group">
					<label>Language</label>
					<select class="form-control">
						<option>English</option>
					</select>
				</div>
				<div class="form-group">
					<button class="btn btn-primary form-control">
						Update Level
					</button>
				</div>
			</form>
		</div>
	</div>
@endsection