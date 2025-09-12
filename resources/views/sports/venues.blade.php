@extends('layouts.app')

@section('content')
<h2>{{ $type }} 場館</h2>

@if($venues->isEmpty())
    <p>目前沒有 {{ $type }} 場館。</p>
@else
    <ul>
        @foreach($venues as $venue)
            <li>
                <a href="{{ route('sports.show', [$slug, $venue]) }}">
                    {{ $venue->name }}
                </a>
            </li>
        @endforeach
    </ul>
@endif
@endsection
