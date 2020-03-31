@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<form method="post" action="{{ route('profile.subject.update', compact('profile', 'subject')) }}">
				@csrf
				@method('PATCH')
				<div class="form-group">
					<label>Subject Name</label>
					<input type="text" name="name" class="form-control" value="{{ $subject->name }}">
				</div>
				<div class="form-group">
					<label>Published</label>
					<select class="form-control" name="published">
						<option value="1" @if($subject->published === 1) selected @endif>Published</option>
						<option value="0" @if($subject->published === 0) selected @endif>Unpublished</option>
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
						Update Subject
					</button>
				</div>
			</form>
		</div>
	</div>
@endsection