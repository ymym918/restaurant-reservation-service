@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<header>
    <div class="search-container">
    <!-- 検索フォーム -->
    <form action="{{ route('restaurants.search') }}" method="GET" class="search-form">
        <!-- areaカテゴリー選択肢 -->
        <select name="prefecture">
            <option value="">All area</option>
            @foreach ($prefectures as $prefecture)
            <option value="{{ $prefecture->name }}" {{ request('prefecture') == $prefecture->name ? 'selected' : '' }}>
                {{ $prefecture->name }}
            </option>
            @endforeach
        </select>
        <!-- genreカテゴリー選択肢 -->
        <select name="genre">
        <option value="">All genre</option>
        @foreach ($genres as $genre)
            <option value="{{ $genre->name }}" {{ request('genre') == $genre->name ? 'selected' : '' }}>
                {{ $genre->name }}
            </option>
        @endforeach
        </select>
        <!-- キーワード検索 -->
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="🔍Search...">
        <button type="submit"></button>
    </form>

    <!-- 検索条件に該当する飲食店がない時にメッセージを返す -->
    @if(isset($noResultsMessage))
    <div class="alert alert-warning">
        {{ $noResultsMessage }}
    </div>
    @endif
</header>

<main>
    <div class="grid-container">
        @foreach($restaurants as $restaurant)
        <div class="card">
            <img src="{{ $restaurant->image_path }}" alt="{{ $restaurant->name }}">
            <div class="card-info">
                <h2>{{ $restaurant->name }}</h2>
                <p>#{{ $restaurant->prefecture->name }} #{{ $restaurant->genre->name }}</p>
                <a href="{{ route('restaurant.detail', $restaurant->id) }}">詳しくみる</a>
                <span class="favorite">
                    <!-- お気に入りの状態によってclassを切り替え -->
                    <span class="heart {{ $restaurant->isFavoritedBy(Auth::user()) ? 'heart-filled' : 'heart-empty' }}"
                        onclick="toggleFavorite(this, {{ $restaurant->id }})">
                        &#x2665;
                    </span>
                </span>
            </div>
        </div>
        @endforeach
    </div>
</main>

<script>
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

// 検索結果がない場合、5秒後に飲食店一覧ページにリダイレクト
    @if(isset($noResultsMessage))
        setTimeout(function() {
            window.location.href = "{{ route('restaurant.index') }}";  // 飲食店一覧ページにリダイレクト
        }, 5000); // 5秒後にリダイレクト
    @endif
</script>

@endsection
