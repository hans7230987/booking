@extends('layouts.app')

@section('content')
    {{-- <h2 class="mb-4 fw-bold text-center">登入</h2> --}}
    <form method="POST" action="{{ route('login') }}"><br>
        @csrf
        <div class="form-group">
            <label for="email">電子郵件</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            @error('email')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">密碼</label>
            <input type="password" name="password" id="password" required>
            @error('password')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <button type="submit">登入</button>
        </div>
    </form>
@endsection
