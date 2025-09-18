@extends('layouts.app')

@section('content')
<div class="container2 my-5">
    <div class="mb-4 text-center">
        <h2 class="fw-bold">{{ $venue->name }}的{{ $type }}場地</h2>
        <p class="text-muted">{{ $venue->address }}</p>
        @if($venue->description)
        <p>{{ $venue->description }}</p>
        @endif
        @if($venue->capacity)
        <p>容量：{{ $venue->capacity }} 人</p>
        @endif
    </div>

    @if($venue->courts->isEmpty())
    <p class="text-muted text-center">這個場館目前沒有 {{ $type }} 場地。</p>
    @else
    <div class="row g-4">
        @foreach($venue->courts as $court)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $court->name }} <small class="text-muted">({{ $court->type }})</small></h5>

                    @auth
                    <form action="{{ route('bookings.store') }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="court_id" value="{{ $court->id }}">

                        <div class="mb-2">
                            <label for="start_time" class="form-label">預約開始時間：</label>
                            <input type="text" name="start_time" class="form-control datetimepicker" required>
                        </div>
                        <div class="mb-2">
                            <label for="end_time" class="form-label">預約結束時間：</label>
                            <input type="text" name="end_time" class="form-control datetimepicker" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-2">預約這個場地</button>
                    </form>
                    @else
                    <p class="mt-3 text-center">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">登入</a> 以預約這個場地。
                    </p>
                    @endauth

                    @if($court->bookings->isNotEmpty())
                    <div class="mt-3">
                        <h6>已預約時間：</h6>
                        <ul class="list-group list-group-flush">
                            @foreach($court->bookings as $booking)
                            <li class="list-group-item px-0">
                                {{ $booking->start_time }} ~ {{ $booking->end_time }} <span class="text-muted">由 {{ $booking->user->name }} 預約</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    flatpickr(".datetimepicker", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: "today",
        minuteIncrement: 30, // 每格 30 分鐘
        time_24hr: true, // 24小時制
    });
</script>
@endpush