@extends('layouts.app')

@section('content')
<div class="container2 py-5">
    <h1 class="mb-2 fw-bold text-center">我的預約</h1>

    @if($bookings->isEmpty())
    <p>目前還沒有預約任何場地。</p>
    @else
    <div class="row g-4">
        @foreach($bookings as $booking)
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $booking->venue->name }}</h5>
                    <p class="card-text">
                        <strong>日期：</strong> {{ $booking->start_time->format('Y-m-d') }} - {{ $booking->end_time->format('Y-m-d') }}<br>
                        <strong>時段：</strong> {{ $booking->start_time->format('H:i') }} - {{ $booking->end_time->format('H:i') }}<br>
                        <strong>狀態：</strong>
                        @if($booking->status == 'confirmed')
                        <span class="text-success">已確認</span>
                        @else
                        <span class="text-warning">{{ $booking->status }}</span>
                        @endif
                    </p>
                    <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">取消預約</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection