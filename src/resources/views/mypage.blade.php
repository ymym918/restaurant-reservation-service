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

        <div class="modal" id="deleteModal" style="display: none;">
            <div class="modal-content">
                <p>予約を削除しますか？</p>
                <div class="modal-buttons">
                    <!-- 削除ボタン -->
                    <form id="deleteForm" action="" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">削除する</button>
                    </form>
                    <!-- キャンセルボタン -->
                    <button class="btn btn-secondary" id="cancelButton">キャンセル</button>
                </div>
            </div>
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
                        <div class="reservation-title">
                            <i class="fas fa-clock"></i>
                            <p>予約{{ $loop->iteration }}</p>
                            <form action="{{ route('reservation.softDelete', $reservation->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="delete-button" data-action="{{ route('reservation.softDelete', $reservation->id) }}" aria-label="削除">×</button>
                            </form>
                        </div>
                        <p><span class="label">Shop</span> <span class="data-shop">{{ $reservation->restaurant->name }}</span></p>
                        <p><span class="label">Date</span> <span class="data">{{ $reservation->reservation_date }}</span></p>
                        <p><span class="label">Time</span> <span class="data">{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}</span></p>
                        <p><span class="label">Number</span> <span class="data-number">{{ $reservation->number_of_people }}人</span></p>
                        <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn btn-link">変更する</a>
                        {{-- 来店予約日時経過後、評価ページにアクセスできるようにする --}}
                        @if (\Carbon\Carbon::parse($reservation->reservation_date . ' ' . $reservation->reservation_time) < now())
                        <a href="{{ route('reviews.create', $reservation->id) }}" class="btn btn-review">レビューを書く</a>
                        @endif
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
                <div class="favorite-cards">
                    @foreach ($favorites as $favorite)
                    <div class="favorite-card">
                        <img src="{{ $favorite->restaurant->image_path }}" alt="{{ $favorite->restaurant->name }}">
                        <div class="card-info">
                            <h3>{{ $favorite->restaurant->name }}</h3>
                            <p>#{{ $favorite->restaurant->prefecture->name }} #{{ $favorite->restaurant->genre->name }}</p>
                            <a href="{{ route('restaurant.detail', $favorite->restaurant->id) }}" class="btn btn-link">詳しくみる</a>
                            <span class="favorite">
                                <span class="heart {{ $favorite->isFavoritedBy(Auth::id(), $favorite->restaurant->id) ? 'heart-filled' : 'heart-empty' }}"
        onclick="toggleFavorite(this, {{ $favorite->restaurant->id }})">&#x2665;
                                </span>
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
</main>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".delete-button");
    const modal = document.getElementById("deleteModal");
    const cancelButton = document.getElementById("cancelButton");
    const deleteForm = document.getElementById("deleteForm");

    // 各削除ボタンにクリックイベントを設定
    deleteButtons.forEach(button => {
        button.addEventListener("click", function () {
            const actionUrl = this.getAttribute("data-action"); // データ属性からアクションURLを取得
            deleteForm.action = actionUrl; // モーダル内のフォームにURLを設定
            modal.style.display = "flex"; // モーダルを表示
        });
    });

    // キャンセルボタンにクリックイベントを設定
    cancelButton.addEventListener("click", function () {
        modal.style.display = "none"; // モーダルを閉じる
    });
});

function toggleFavorite(element, restaurantId) {
    // ハートの中身を切り替え (塗りつぶし or 空)
    if (element.classList.contains('heart-empty')) {
        element.classList.remove('heart-empty');
        element.classList.add('heart-filled');
        addFavorite(restaurantId); // お気に入り追加
    } else {
        element.classList.remove('heart-filled');
        element.classList.add('heart-empty');
        removeFavorite(restaurantId); // お気に入り削除
    }
}

// お気に入り登録
function addFavorite(restaurantId) {
    fetch(`/like/${restaurantId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('お気に入り追加:', data);
    })
    .catch(error => console.error('エラー:', error));
}

// お気に入り削除
function removeFavorite(restaurantId) {
    fetch(`/like/${restaurantId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('お気に入り削除:', data);
    })
    .catch(error => console.error('エラー:', error));
}
</script>

@endsection
