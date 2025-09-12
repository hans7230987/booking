@extends('layouts.app')

@section('content')
<h2>{{ $venue->name }} 的 {{ $type }} 場地</h2>
<p>地址：{{ $venue->address }}</p>

@if($venue->description)
    <p>簡介：{{ $venue->description }}</p>
@endif
@if($venue->capacity)
    <p>容量：{{ $venue->capacity }} 人</p>
@endif

@if($venue->courts->isEmpty())
    <p>這個場館目前沒有 {{ $type }} 場地。</p>
@else
    @foreach($venue->courts as $court)
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <h3>{{ $court->name }} ({{ $court->type }})</h3>

            @auth
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="court_id" value="{{ $court->id }}">
                    <div class="form-group">
                        <label for="start_time">預約開始時間：</label>
                        <input type="text" name="start_time" class="datetimepicker" required>
                        <!-- <input type="datetime-local" name="start_time" required> -->
                    </div>
                    <div class="form-group">
                        <label for="end_time">預約結束時間：</label>
                        <input type="text" name="end_time" class="datetimepicker" required>
                        <!-- <input type="datetime-local" name="end_time" required> -->
                    </div>
                    <button type="submit">預約這個場地</button>
                </form>
            @else
                <p><a href="{{ route('login') }}">登入</a>以預約這個場地。</p>
            @endauth

            @if($court->bookings->isNotEmpty())
                <h4>已預約時間：</h4>
                <ul>
                    @foreach($court->bookings as $booking)
                        <li>{{ $booking->start_time }} ~ {{ $booking->end_time }} 由 {{ $booking->user->name }} 預約</li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endforeach
@endif
@endsection

@push('scripts')
<script>
    flatpickr(".datetimepicker", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: "today",
    });
</script>
@endpush