@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-sm-12">
			@cannot('publishAny', $lesson)
				<div class="alert alert-warning">
					Making a change to this lesson will cause the lesson to become unpublished whilst a member of the team rereviews the lesson.
				</div>
			@endcannot
			<form action="{{ route('profile.lesson.update', compact('lesson')) }}" method="post" enctype="multipart/form-data">
				<div class="card">
						@csrf
						@method('PATCH')
						<div class="card-header">
							Edit Lesson
						</div>
						<div class="card-body">
							@include('layouts.messages')
							<div class="form-group">
								<label>Lesson Name</label>
								<input class="form-control" type="text" name="name" value="{{ old('name') ?? $lesson->name }}">
							</div>
							<div class="form-group">
								<label>Lesson Description</label>
								<textarea name="description" class="form-control">{{ old('description') ?? $lesson->description }}</textarea>
							</div>
							<div class="form-group">
								<label>Subject</label>
								<select name="subject_id" class="form-control">
									@foreach($subjects as $subject)
										<option value="{{ $subject->id }}"
										@if($subject->id === old('subject_id') || $subject->id === $lesson->subject_id)
											selected
										@endif
										>
											{{ $subject->name }}
										</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Level</label>
								<select name="level_id" class="form-control">
									@foreach($levels as $level)
										<option value="{{ $level->id }}"
										@if($level->id === old('level_id') || $level->id === $lesson->level_id)
											selected
										@endif
										>
											{{ $level->name }}
										</option>
									@endforeach
								</select>
							</div>
							<div class="form-group">
								<label>Existing Learning Material</label>
								<ul class="list-group">
									@foreach($lesson->learningMaterials as $learningMaterial)
										<li class="list-group-item">
											{{ $learningMaterial->original_name }} - {{ $learningMaterial->size }}Kb
											<span>
												{{-- <form id="delete-learning-material-{{ $learningMaterial->id }}" action="{{ route('profile.learning-material.destroy', ['profile' => $profile, 'learning_material' => $learningMaterial]) }}" class="d-inline-block float-right" method="post">
													@csrf()
													@method('DELETE')
													<button form="delete-learning-material-{{ $learningMaterial->id }}" class="btn btn-outline-danger btn-sm float-right">Delete</button>
												</form> --}}
												<a href="{{ route('file-download.show', ['file' => $learningMaterial->file, 'type' => 'learningMaterial' ]) }}" class="btn btn-outline-success btn-sm float-right mr-1">Download</a>
											</span>
										</li>
									@endforeach
								</ul>
							</div>
							<div class="form-group">
								<label>Learning Materials</label>
								<input class="form-control" type="file" name="learning_materials[]" multiple>
							</div>
							<div class="form-group">
								<label>Existing Worksheet Material</label>
								<ul class="list-group">
									@foreach($lesson->worksheets as $worksheet)
										<li class="list-group-item">
											{{ $worksheet->original_name }} - {{ $worksheet->size }}Kb
											<span>
												{{-- <form action="{{ route('profile.worksheet.destroy', compact('profile', 'worksheet')) }}" class="d-inline-block float-right" method="post">
													@csrf()
													@method('DELETE')
													<button class="btn btn-outline-danger btn-sm float-right">Delete</button>
												</form> --}}
												<a href="{{ route('file-download.show', ['file' => $worksheet->file, 'type' => 'worksheet' ]) }}" class="btn btn-outline-success btn-sm float-right mr-1">Download</a>
											</span>
										</li>
									@endforeach
								</ul>
							</div>
							<div class="form-group">
								<label>Worksheets</label>
								<input class="form-control" type="file" name="worksheets[]" multiple>
								<div class="alert alert-warning mt-2 border">
									You can upload multiple learning materials and worksheets. We prefer if these are in PDF format, but other document types are accepted too.
								</div>
							</div>
							<div class="form-group">
								<label>Created By</label>
								<input type="text" class="form-control" value="{{ $lesson->user->name }}" readonly>
							</div>
							@can('publishAny', $lesson)
								<div class="form-group">
									<label>Published</label>
									<select name="published" class="form-control">
										<option value="1"
										@if($lesson->published) selected @endif>Published</option>
										<option value="0"
										@if(!$lesson->published) selected @endif>Unpublished</option>
									</select>
								</div>
							@endcan
							<div class="form-group">
								<label>Show Author Name?</label>
								<select class="form-control" name="show_author">
									<option value="1">Show author name on lesson listing</option>
									<option value="0">Do not show author name on lesson listing</option>
								</select>
							</div>
						</div>
						<div class="card-footer">
							<button class="btn btn-primary float-right">Update Lesson</button>
						</div>
				</div>
			</form>
		</div>
	</div>
@endsection
