@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2 class="mb-4 fw-bold">{{ $type }} 場館</h2>

    @if($venues->isEmpty())
        <p class="text-muted">目前沒有 {{ $type }} 場館。</p>
    @else
        {{-- 卡片列表 --}}
        <div class="row g-4">
            @foreach($venues as $venue)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm venue-card">
                        @if($venue->image_url)
                            <img src="{{ asset('storage/'.$venue->image_url) }}"
                                 class="card-img-top"
                                 alt="{{ $venue->name }}">
                        @else
                            {{-- Skeleton 圖片 --}}
                            <div class="skeleton-img"></div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $venue->name }}</h5>
                            @if($venue->address)
                                <p class="card-text text-muted small mb-3">{{ $venue->address }}</p>
                            @else
                                <div class="skeleton-line w-75"></div>
                            @endif
                            <a href="{{ route('sports.show', [$slug, $venue]) }}"
                               class="btn btn-primary btn-sm">
                                預約此館
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
