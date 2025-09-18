@extends('layouts.app')

@section('content')
<div class="container2 my-4">
    <h2 class="mb-4 fw-bold text-center">所有球館</h2>

    @if($venues->isEmpty())
        <p class="text-muted">目前沒有可預約的球館。</p>
    @else
        {{-- 卡片列表 --}}
        <div class="row g-4">
            @foreach($venues as $venue)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm venue-card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $venue->name }}</h5>

                            @if(!empty($venue->address))
                                <p class="card-text text-muted small mb-3">
                                    {{ $venue->address }}
                                </p>
                            @endif

                            @if(!empty($venue->description))
                                <p class="text-muted small mb-3">
                                    {{ Str::limit($venue->description, 50) }}
                                </p>
                            @endif

                            <a href="{{ route('venues.show', $venue) }}"
                               class="btn btn-primary btn-sm">
                                查看此館全部場地
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
