@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<body>
    <div class="header__wrap">
        <p class="header__text">
            {{ \Auth::user()->name }}さん
        </p>
    </div>
    <main>
        <div class="content-wrapper">
        {{-- 予約状況 --}}
            <div class="reservation-status">
                    <p><label for="shop_name">Shop</label>{{ $restaurant->name }}</p>
                    <p><label for="reservation_date">Date</label><span id="confirm_date"
                        class="reservation-spacing"></span></p>
                    <p><label for="reservation_time">Time</label><span id="reservation_time" class="reservation-spacing"></span></p>
                    <p><label for="reservation_people">Number</label><span id="reservation_people" class="creservation-spacing"></span></p>
                </div>
            </div>

        {{-- お気に入り店舗 --}}
            <div class="favorite-restaurant">
                <p>お気に入り店舗</p>
            </div>
                <div class="grid-container">
                    <div class="card">
                        <img src="{{ $restaurant->image_path }}" alt="{{ $restaurant->name }}">
                        <div class="card-info">
                            <h2>{{ $restaurant->name }}</h2>
                            <p>#{{ $restaurant->prefecture->name }} #{{ $restaurant->genre->name }}</p>
                            <a href="{{ route('restaurant.detail', $restaurant->id) }}" >詳しく見る</a>
                            <span class="favorite" onclick="toggleFavorite(this)">&#x2661;</span>
                        </div>
                    </div>
    </main>
</body>

@endsection
