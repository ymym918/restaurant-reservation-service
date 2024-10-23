@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

<body>
{{-- 飲食店詳細ページ部分 --}}
@section('content')
<main class="main-content">
    <a href="{{ route('restaurant.index') }}">＜</a>
    <h2>{{ $restaurant->name }}</h2>
    <img src="{{ $restaurant->image_path }}" alt="{{ $restaurant->name }}">
    <p>#{{ $restaurant->prefecture->name }} #{{ $restaurant->genre->name }}</p>
    <p>{{ $restaurant->description }}</p>
</main>

{{-- 予約フォーム --}}
<div class="reservation-form">
    <h2>予約</h2>
    <form action="{{ route('reservations.store') }}" method="post" >
    @csrf
    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

    {{-- 予約年月日 --}}
    <label for="date"></label>
    <input type="date" id="date" name="reservation_date" required>
    {{-- 予約時間 --}}
    <label for="time"></label>
    <select id="time" name="reservation_time" required>
        <option value="11:00">11:00</option>
        <option value="12:00">12:00</option>
        <option value="13:00">13:00</option>
        <option value="14:00">14:00</option>
        <option value="15:00">15:00</option>
        <option value="16:00">16:00</option>
        <option value="17:00">17:00</option>
        <option value="18:00">18:00</option>
        <option value="19:00">19:00</option>
        <option value="20:00">20:00</option>
        <option value="21:00">21:00</option>
    </select>
    {{-- 予約人数 --}}
    <label for="number"></label>
    <select id="number" name="number_of_people" required>
        <option value="1">1人</option>
        <option value="2">2人</option>
        <option value="3">3人</option>
        <option value="4">4人</option>
        <option value="5">5人</option>
        <option value="6">6人</option>
        <option value="7">7人</option>
        <option value="8">8人</option>
        <option value="9">9人</option>
        <option value="10">10人</option>
        <option value="11">10人以上</option>
    </select>

{{-- 確認セクション--}}
    <div class="reservation-summary">
        <div id="confirmation_section">
        <p>Shop{{ $restaurant->name }}</p>
        <p id="confirm_date">Date </p>
        <p id="confirm_time">Time </p>
        <p id="confirm_people">Number </p>
    </div>
    <button type="submit">予約する</button>
    </form>
    </div>
</div>
</body>

{{-- <!-- 外部JavaScriptファイルの読み込み -->
    <script src="{{ asset('js/reservation.js') }}"></script> --}}
@endsection

