@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<header>
    <div class="header-right">
        <select class="filter" name="area">
            <option value="all">All areas</option>
            <option value="tokyo">Tokyo</option>
            <option value="osaka">Osaka</option>
            <option value="fukuoka">Fukuoka</option>
        </select>
        <select class="filter" name="genre">
            <option value="all">All genres</option>
            <option value="sushi">Sushi</option>
            <option value="yakiniku">Yakiniku</option>
            <option value="izakaya">Izakaya</option>
            <option value="ramen">Ramen</option>
            <option value="italian">Italian</option>
        </select>
        <input type="text" class="search-bar" placeholder="Search ...">
    </div>
</header>

<main>
    <div class="grid-container">
        @foreach($restaurants as $restaurant)
        <div class="card">
            <img src="{{ $restaurant->image_path }}" alt="{{ $restaurant->name }}">
            <div class="card-info">
                <h2>{{ $restaurant->name }}</h2>
                <p>#{{ $restaurant->prefecture->name }} #{{ $restaurant->genre->name }}</p>
                <a href="{{ route('restaurant.detail', $restaurant->id) }}">詳しく見る</a>
                <span class="favorite">
                    <!-- お気に入りの状態によってclassを切り替え -->
                    <span
                        class="heart {{ $restaurant->isFavoritedBy(Auth::user()) ? 'heart-filled' : 'heart-empty' }}"
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
</script>

@endsection
