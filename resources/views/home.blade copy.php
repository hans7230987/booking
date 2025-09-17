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
                <li>xxx俱樂部正式開放線上預約場地</li>
            </ul>
        </div>
    </div>

    <!-- 右側功能圖示 -->
    <div class="features">
        <div class="feature-row">
            <a href="#"><div class="feature yellow">我的訂單</div></a>
            <a href="#"><div class="feature yellow">會員票券信託查詢</div></a>
            <a href="#"><div class="feature yellow">票券信託查詢</div></a>
        </div>
        <div class="feature-row">
            <a href="#"><div class="feature purple">課程查詢</div></a>
            <a href="{{ route('courses.index') }}"><div class="feature purple">課程報名</div></a>
            <a href="#"><div class="feature orange">場地季租</div></a>
        </div>
        <div class="feature-row">
            <a href="{{ route('venues.index') }}"><div class="feature orange">羽球</div></a>
            <a href="{{ route('venues.index') }}"><div class="feature orange">籃球</div></a>
            <a href="{{ route('venues.index') }}"><div class="feature orange">桌球</div></a>
        </div>
        <div class="feature-row">
            <a href="{{ route('venues.index') }}"><div class="feature orange">壁球</div></a>
        </div>
    </div>
</div>

<!-- 底部說明 -->
<footer>
    <p>本系統建議使用 Google Chrome 瀏覽器</p>
</footer>
@endsection
