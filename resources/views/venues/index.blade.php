@extends('layouts.app')

@section('content')
<h2>所有球館</h2>

@if($venues->isEmpty())
<p>目前沒有可預約的球館。</p>
@else
<ul>
    @foreach($venues as $venue)
    <li>
        <a href="{{ route('venues.show', $venue) }}">
            {{ $venue->name }}
        </a>
    </li>
    @endforeach
</ul>
@endif
@endsection