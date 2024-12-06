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
                <form action="{{ route('reservation.store') }}" method="post">
                    @csrf

                    {{-- 飲食店名 --}}
                    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

                    {{-- 予約年月日 --}}
                    <label for="reservation_date"></label>
                    <input type="date" id="reservation_date" name="reservation_date">
                    @error('reservation_date')
                    <div class="error">{{ $message }}</div>
                    @enderror

                    {{-- 予約時間 --}}
                    <label for="reservation_time"></label>
                    <select id="reservation_time" name="reservation_time">
                        <option value="" disabled selected>予約時間を選択してください</option>
                        @foreach (['11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00'] as $time)
                            <option value="{{ $time }}">{{ $time }}</option>
                        @endforeach
                    </select>
                    @error('reservation_time')
                    <div class="error">{{ $message }}</div>
                    @enderror

                    {{-- 予約人数 --}}
                    <label for="number_of_people"></label>
                    <select id="number_of_people" name="number_of_people">
                        <option value="" disabled selected>予約人数を選択してください</option>
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}人</option>
                        @endfor
                    </select>
                    @error('number_of_people')
                    <div class="error">{{ $message }}</div>
                    @enderror

                    {{-- 確認セクション --}}
                    <div class="reservation-summary">
                        <p><label for="shop_name">Shop</label>{{ $restaurant->name }}</p>
                        <p><label for="confirm_date">Date</label><span id="confirm_date" class="confirmation-spacing"></span></p>
                        <p><label for="confirm_time">Time</label><span id="confirm_time" class="confirmation-spacing"></span></p>
                        <p><label for="confirm_people">Number</label><span id="confirm_people" class="confirmation-spacing"></span></p>
                    </div>
                    <div class="button-container">
                        <button type="submit">予約する</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // 要素を取得
        const reservationDate = document.getElementById('reservation_date');
        const reservationTime = document.getElementById('reservation_time');
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

    // 今日の日付を取得してフォーマット(予約年月日の選択を今日以降に限定)
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('reservation_date').setAttribute('min', today);
    </script>
</body>

@endsection
