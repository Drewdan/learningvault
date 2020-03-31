@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<form method="post" action="{{ route('profile.level.store', compact('profile')) }}">
				@csrf
				<div class="form-group">
					<label>Level Name</label>
					<input type="text" name="name" class="form-control" value="{{ old('name') }}">
				</div>
				<div class="form-group">
					<label>Level Description</label>
					<textarea name="description" class="form-control">{{ old('description') }}</textarea>
				</div>
				<div class="form-group">
					<label>Language</label>
					<select class="form-control">
						<option>English</option>
					</select>
				</div>
				<div class="form-group">
					<button class="btn btn-primary form-control">
						Create Level
					</button>
				</div>
			</form>
		</div>
	</div>
@endsection