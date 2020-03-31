@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<form method="post" action="{{ route('profile.subject.store', compact('profile')) }}">
				@csrf
				<div class="form-group">
					<label>Subject Name</label>
					<input type="text" name="name" class="form-control" value="{{ old('name') }}">
				</div>
				<div class="form-group">
					<label>Published</label>
					<select class="form-control" name="published">
						<option value="1" @if(old('published') === '1') selected @endif>Published</option>
						<option value="0" @if(old('published') === '0') selected @endif>Unpublished</option>
					</select>
				</div>
				<div class="form-group">
					<label>Language</label>
					<select class="form-control">
						<option>English</option>
					</select>
				</div>
				<div class="form-group">
					<button class="btn btn-primary form-control">
						Create Subject
					</button>
				</div>
			</form>
		</div>
	</div>
@endsection