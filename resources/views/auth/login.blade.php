@extends('layouts.app')

@section('content')
    <h2>登入</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">電子郵件</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="password">密碼</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="form-group">
            <button type="submit">登入</button>
        </div>
    </form>
@endsection