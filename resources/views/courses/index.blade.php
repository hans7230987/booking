@extends('layouts.app')

@section('content')
<div class="container2 my-5">
    <h1 class="mb-4 fw-bold text-center">📚 課程報名</h1>

    @if(empty($courses))
    <div class="alert alert-info text-center shadow-sm">
        目前沒有開放的課程。
    </div>
    @else
    <div class="row g-4">
        @foreach($courses as $course)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold text-primary">
                        {{ $course['name'] }}
                    </h5>
                    <p class="card-text text-muted flex-grow-1">
                        {{ $course['description'] }}
                    </p>
                    <a href="#"
                        class="btn btn-outline-primary mt-auto rounded-pill">
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