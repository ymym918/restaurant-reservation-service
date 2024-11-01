@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<body>
    <main>
        <div class="content-wrapper">
        {{-- 飲食店詳細ページ部分 --}}
            <div class="main-content">
                <div class="title-container">
                    <a href="{{ route('restaurant.index') }}">＜</a>
                    <h2>{{ $restaurant->name }}</h2>
                </div>
                <img src="{{ $restaurant->image_path }}" alt="{{ $restaurant->name }}">
                <p>#{{ $restaurant->prefecture->name }} #{{ $restaurant->genre->name }}</p>
                <p>{{ $restaurant->description }}</p>
            </div>

        {{-- 予約フォーム --}}
            <div class="reservation-form">
                <h2>予約</h2>
                <form action="{{ route('reservation.store') }}" method="post" >
                @csrf
                <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                {{-- 予約年月日 --}}
                <label for="reservation_date"></label>
                <input type="date" id="reservation_date" name="reservation_date" required>
                {{-- 予約時間 --}}
                <label for="time"></label>
                <select id="time" name="reservation_time" class="custom-select" required>
                    <option value="" disabled selected>予約時間を選択してください</option>
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
                <label for="number_of_people"></label>
                <select id="number_of_people" name="number_of_people" class="custom-select" required>
                    <option value="" disabled selected>予約人数を選択してください</option>
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
                </select>
                <div class="button-container">
                <button type="submit">予約する</button>
                </div>
                {{-- 確認セクション--}}
                <div class="reservation-summary">
                    <p><label for="shop_name">Shop</label>{{ $restaurant->name }}</p>
                    <p><label for="confirm_date">Date</label><span id="confirm_date" class="confirmation-spacing"></span></p>
                    <p><label for="confirm_time">Time</label><span id="confirm_time" class="confirmation-spacing"></span></p>
                    <p><label for="confirm_people">Number</label><span id="confirm_people" class="confirmation-spacing"></span></p>
                </div>
                </form>
            </div>
        </div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
    // 要素を取得
    const reservationDate = document.getElementById('reservation_date');
    const reservationTime = document.getElementById('time');
    const numberOfPeople = document.getElementById('number_of_people');

    // 確認セクションの要素を取得
    const confirmDate = document.getElementById('confirm_date');
    const confirmTime = document.getElementById('confirm_time');
    const confirmPeople = document.getElementById('confirm_people');

    // イベントリスナーを追加して動的に更新
    reservationDate.addEventListener('change', function() {
        confirmDate.textContent = reservationDate.value;
    });
    reservationTime.addEventListener('change', function() {
        confirmTime.textContent = reservationTime.value;
    });
    numberOfPeople.addEventListener('change', function() {
        confirmPeople.textContent = numberOfPeople.value + '人';
    });
});
    </script>
</body>

@endsection
