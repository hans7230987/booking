@extends('layouts.app')

@section('content')
<div class="container2 my-5">
    <div class="text-center p-5 bg-light rounded shadow-sm">
        <h1 class="fw-bold text-success mb-4">報名成功！</h1>

        <p class="fs-5">
            恭喜你已成功報名：
            <strong>{{ $course['name'] }}</strong>
        </p>

        @if(!empty($course['description']))
            <p class="text-muted mb-4">{{ $course['description'] }}</p>
        @endif

        <a href="{{ route('courses.index') }}" class="btn btn-primary rounded-pill px-4">
            返回課程列表
        </a>
    </div>
</div>
@endsection
