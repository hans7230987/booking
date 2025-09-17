@extends('layouts.app')

@section('content')
<div class="dashboard">

    <!-- 左側 LOGO + 最新消息 -->
    <div class="sidebar">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Wave Sunshine Logo">
        </div>
        <div class="news-box">
            <h3>最新消息</h3>
            <ul>
                <li>球館通正式開放線上預約場地</li>
            </ul>
        </div>
    </div>

    <!-- 右側功能圖示 -->
    <div class="features">
        <div class="feature-row">
            <a href="{{ route('sports.index', 'badminton') }}"><div class="feature green">
                <img src="{{ asset('images/icons/badminton.png') }}" alt="羽球">
                <span>羽球</span>
            </div></a>
            <a href="{{ route('sports.index', 'basketball') }}"><div class="feature green">
                <img src="{{ asset('images/icons/basketball.png') }}" alt="籃球">
                <span>籃球</span>
            </div></a>
            <a href="{{ route('sports.index', 'tabletennis') }}"><div class="feature green">
                <img src="{{ asset('images/icons/tabletennis.png') }}" alt="桌球">
                <span>桌球</span>
            </div></a>
        </div>
        <div class="feature-row">
            <a href="{{ route('my.bookings') }}"><div class="feature blue">
                <img src="{{ asset('images/icons/order.png') }}" alt="我的訂單">
                <span>我的訂單</span>
            </div></a>
            <a href="{{ route('profile.show') }}"><div class="feature blue">
                <img src="{{ asset('images/icons/member.png') }}" alt="我的資料">
                <span>我的資料</span>
            </div></a>
            <!-- <a href="#"><div class="feature yellow">
                <img src="{{ asset('images/icons/ticket.png') }}" alt="票券信託查詢">
                <span>票券信託查詢</span>
            </div></a> -->
        </div>
        <div class="feature-row">
            <a href="#"><div class="feature yellow">
                <img src="{{ asset('images/icons/course_search.png') }}" alt="課程查詢">
                <span>課程查詢</span>
            </div></a>
            <a href="{{ route('courses.index') }}"><div class="feature yellow">
                <img src="{{ asset('images/icons/course_register.png') }}" alt="課程報名">
                <span>課程報名</span>
            </div></a>
            <a href="#"><div class="feature yellow">
                <img src="{{ asset('images/icons/season_rent.png') }}" alt="場地季租">
                <span>場地季租</span>
            </div></a>
        </div>
        
        <!-- <div class="feature-row">
            <a href="{{ route('venues.index') }}"><div class="feature green">
                <img src="{{ asset('images/icons/squash.png') }}" alt="壁球">
                <span>壁球</span>
            </div></a>
        </div> -->
    </div>
</div>

<!-- 底部說明 -->
<!-- <footer>
    <p>本系統建議使用 Google Chrome 瀏覽器</p>
</footer> -->
@endsection
