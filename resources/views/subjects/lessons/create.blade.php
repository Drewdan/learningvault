@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col">
			<div class="alert alert-info border">
				<p>At Opensource learning we depend on the support from the community to create content for our users. Thank you for taking the time to upload a lesson to our database.</p>
				<p>Once you have submitted your lessons, it will be reviewed by a content moderator before being published to the website. Our moderators are usually pretty quick, but this can take a while if the content you submit is extensive.</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			@include('layouts.messages')
			<form action="{{ route('lesson.store', compact('subject')) }}" method="post" enctype="multipart/form-data">
				@csrf()
				<div class="form-group">
					<label>Subject Name</label>
					<input class="form-control" type="text" value="{{ $subject->name }}" readonly>
				</div>
				<div class="form-group">
					<label>Lesson Name</label>
					<input class="form-control" type="text" name="name" value="{{ old('name') }}">
				</div>
				<div class="form-group">
					<label>Lesson Description</label>
					<textarea class="form-control" name="description">{{ old('description') }}</textarea>
				</div>
				<div class="form-group">
					<label>Skill Level</label>
					<select class="form-control" name="level_id">
						<option>Not Sure</option>
						@foreach($levels as $level)
							<option value="{{ $level->id }}" {{ ($level->id === old('level_id')) ? 'selected' : '' }}>{{ $level->name }}</option>
						@endforeach
					</select>
					<div class="alert alert-warning mt-2 border">
						Not sure what skill level this lesson fits in? Choose "Not Sure" and our moderators will try to assign it a suitable skill level.
					</div>
				</div>
				<div class="form-group">
					<label>Learning Materials</label>
					<input class="form-control" type="file" name="learning_materials[]" multiple>
				</div>
				<div class="form-group">
					<label>Worksheets</label>
					<input class="form-control" type="file" name="worksheets[]" multiple>
					<div class="alert alert-warning mt-2 border">
						You can upload multiple learning materials and worksheets. We prefer if these are in PDF format, but other document types are accepted too.
					</div>
				</div>
				<div class="form-group">
					<label>Show Author Name?</label>
					<select class="form-control" name="show_author">
						<option value="1">Show author name on lesson listing</option>
						<option value="0">Do not show author name on lesson listing</option>
					</select>
				</div>
				<div class="form-group">
					<label>Lesson Language</label>
					<select class="form-control" name="language_id">
						<option value="1">English</option>
					</select>
				</div>
				<div class="form-group">
					<button class="btn btn-primary form-control">Create Lesson</button>
				</div>
			</form>
		</div>
	</div>
@endsection