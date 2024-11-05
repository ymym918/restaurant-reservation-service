@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')

<body>
    <main>
        {{-- ログインしているユーザー名を表示 --}}
        <div class="header__wrap">
            <p class="header__text">{{ $user->name }}さん</p>
        </div>

        {{-- 予約情報の表示 --}}
            <h2>予約状況</h2>
            @if ($reservations->isEmpty())
                <p>予約はありません。</p>
            @else
            <div class="reservations">
                @foreach ($reservations as $reservation)
                    <div class="reservation-card">
                        <p>Shop{{ $reservation->restaurant->name}}</p>
                        <p>Date{{ $reservation->reservation_date }}</p>
                        <p>Time{{ $reservation->reservation_time }}</p>
                        <p>Number{{ $reservation->number_of_people }}人</p>
                    </div>
                @endforeach
            </div>
            @endif
    </main>
</body>

@endsection


