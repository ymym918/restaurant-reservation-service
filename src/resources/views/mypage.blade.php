@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')

<main>
    <div class="container">
        {{-- 成功メッセージを表示 --}}
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="header__wrap">
            {{-- ログインしているユーザー名を表示 --}}
            <h1 class="header__text">{{ $user->name }}さん</h1>
        </div>

            <div class="mypage-container">
                {{-- 予約情報の表示 --}}
                <div class="reservation-section">
                    <h2>予約状況</h2>
                    @if ($reservations->isEmpty())
                    <p>予約はありません。</p>
                    @else
                    <div class="reservations">
                        @foreach ($reservations as $reservation)
                        <div class="reservation-card">
                            <!-- 時計アイコンと予約番号の表示 -->
                            <div class="reservation-title">
                                <i class="fas fa-clock"></i>
                                <p>予約{{ $loop->iteration }}</p>
                                <!-- 予約削除ボタン -->
                                <form action="{{ route('reservation.softDelete', $reservation->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="delete-button" aria-label="削除">×</button>
                                </form>
                            </div>
                            <!-- 予約情報の表示 -->
                            <p><span class="label">Shop</span> <span class="data-shop">{{$reservation->restaurant->name }}</span></p>
                            <p><span class="label">Date</span> <span class="data">{{ $reservation->reservation_date }}</span></p>
                            <p><span class="label">Time</span> <span class="data">{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}</span></p>
                            <p><span class="label">Number</span> <span class="data-number">{{ $reservation->number_of_people }}人</span></p>
                            <!-- 予約編集ページへアクセス -->
                            <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-link">変更する</a>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- お気に入り店舗の表示 --}}
                <div class="favorites-section">
                    <h2>お気に入り店舗</h2>
                    @if ($favorites->isEmpty())
                    <p>お気に入り店舗はありません。</p>
                    @else
                    <div class="restaurant-cards">
                        @foreach ($favorites as $favorite)
                        <div class="restaurant-card">
                            <img src="{{ $favorite->restaurant->image_path }}" alt="{{ $favorite->restaurant->name }}">
                            <div class="card-info">
                                <h3>{{ $favorite->restaurant->name }}</h3>
                                <p>#{{ $favorite->restaurant->prefecture->name }} #{{ $favorite->restaurant->genre->name }}</p>
                                <a href="{{ route('restaurant.detail', $favorite->restaurant->id) }}" class="btn btn-link">詳しく見る</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
</main>

    <!-- JavaScriptコード -->
    <script>
        // 削除ボタンがクリックされたときにモーダルを表示
        function confirmDelete() {
            event.preventDefault(); // フォームの送信を防ぐ
            document.getElementById('confirmModal').style.display = 'flex'; // モーダルを表示

            // 削除ボタンの「はい」をクリックした場合
            document.getElementById('confirmYes').onclick = function() {
                document.getElementById('delete-form').submit(); // フォームを送信して削除を実行
            };

            // キャンセルボタンをクリックした場合
            document.getElementById('confirmNo').onclick = function() {
                document.getElementById('confirmModal').style.display = 'none'; // モーダルを非表示
            };
        }

        // 予約削除時のフラッシュメッセージ
        window.addEventListener('DOMContentLoaded', (event) => {
            const flashMessage = document.getElementById('flash-message');

            // フラッシュメッセージを表示する
            flashMessage.style.opacity = '1';

            // 4秒後にメッセージを非表示にする
            setTimeout(() => {
                flashMessage.style.opacity = '0';
            }, 4000);
        });
    </script>
</body>

@endsection
