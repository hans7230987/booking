@extends('layouts.app')

@section('content')
<div class="container2 my-5">
    <h1 class="mb-4 fw-bold text-center">課程報名</h1>

    @if(empty($courses))
    <div class="alert alert-info text-center shadow-sm">
        目前沒有開放的課程。
    </div>
    @else
    <div class="row g-4">
        @foreach($courses as $course)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0 course-card">
                <div class="card-body d-flex flex-column text-white">
                    <h5 class="card-title fw-bold">
                        {{ $course['name'] }}
                    </h5>
                    <p class="card-text flex-grow-1">
                        {{ $course['description'] }}
                    </p>
                    <a href="{{ route('courses.register', $course['id']) }}"
                        class="btn btn-outline-light mt-auto rounded-pill">
                        立即報名
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection