@extends('layouts.app')

@section('content')
<h1>課程報名</h1>

@if(empty($courses))
    <p>目前沒有開放的課程。</p>
@else
    <ul>
    @foreach($courses as $course)
        <li>
            <h3>{{ $course['name'] }}</h3>
            <p>{{ $course['description'] }}</p>
            <a href="#">立即報名</a> <!-- 可改成實際報名連結 -->
        </li>
    @endforeach
    </ul>
@endif
@endsection
