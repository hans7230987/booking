<!DOCTYPE html>
<html lang="zh_TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>球館通</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <a href="{{ route('home') }}" class="site-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Wave Sunshine Logo">
                <span>球館通</span>
            </a>
            <div class="auth-links">
                @guest
                <a href="{{ route('home') }}">首頁</a>&nbsp; |
                <a href="{{ route('login') }}">登入</a>&nbsp; |
                <a href="{{ route('register') }}">註冊</a>
                @else
                <span>{{ Auth::user()->name }} 您好</span> |
                <a href="{{ route('home') }}">首頁</a> |
                <a href="{{ route('profile.edit') }}">修改會員資訊</a> |
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    登出
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>
                @endguest
            </div>
        </div>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>
