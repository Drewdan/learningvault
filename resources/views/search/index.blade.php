@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1>Lesson Search</h1>
            <p>Search our library of lessons using the form below.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <form action="{{ route('search.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="parameter" placeholder="Search by lesson name, description or subject" class="form-control" aria-label="search criteria">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            @if($lessons)
                <div class="list-group">
                    @forelse($lessons as $lesson)
                        <a href="{{ route('lesson.show', ['subject' => $lesson->subject, 'lesson' => $lesson]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $lesson->name }}</h5>
                                <small>{{ $lesson->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1">{{ $lesson->description }}</p>
                            <small>{{ $lesson->subject->name }}</small>
                        </a>
                    @empty
                        <p>There are no search results for this search parameter</p>
                    @endforelse
                </div>
            @endif
        </div>
    </div>
    @if($lessons && $lessons->count())
        {{ $lessons->withQueryString()->links() }}
    @endif
@endsection
