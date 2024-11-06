@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

@endsection

@section('content')

<body>
    <main>
        {{-- ログインしているユーザー名を表示 --}}
        <div class="container">
            <div class="header__wrap">
                <h1 class="header__text">{{ $user->name }}さん</h1>
            </div>
        {{-- 予約情報の表示 --}}
            <h2>予約状況</h2>
            @if ($reservations->isEmpty())
                <p>予約はありません。</p>
            @else
                <div class="reservations">
                    @foreach ($reservations as $reservation)
                        <div class="reservation-card">
                            <div class="reservation-number">
                                <i class="fas fa-clock"></i>
                                <p>予約{{ $loop->iteration }}</p>
                            </div> <!-- 時計アイコンと予約番号の表示 -->

                            <p><span class="label">Shop</span> <span class="data-shop">{{ $reservation->restaurant->name }}</span></p>
                            <p><span class="label">Date</span> <span class="data">{{ $reservation->reservation_date }}</span></p>
                            <p><span class="label">Time</span> <span class="data">{{ $reservation->reservation_time }}</span></p>
                            <p><span class="label">Number</span> <span class="data-number">{{ $reservation->number_of_people }}人</span></p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>
</body>

@endsection


