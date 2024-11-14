@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<header>
    <div class="header-right">
        <!-- 検索フォーム -->
        <form action="{{ route('restaurant.index') }}" method="get">
            <select class="filter" name="area">
                <option value="all">All areas</option>
                <option value="tokyo" {{ request('prefecture') == 'Tokyo' ? 'selected' : '' }}>東京</option>
                <option value="osaka" {{ request('prefecture') == 'Osaka' ? 'selected' : '' }}>大阪</option>
                <option value="fukuoka" {{ request('prefecture') == 'Fukuoka' ? 'selected' : '' }}>福岡</option>
            </select>
            <select class="filter" name="genre">
                <option value="all">All genres</option>
                <option value="sushi" {{ request('genre') == '寿司' ? 'selected' : '' }}>寿司</option>
                <option value="yakiniku" {{ request('genre') == '焼肉' ? 'selected' : '' }}>焼肉</option>
                <option value="izakaya" {{ request('genre') == '居酒屋' ? 'selected' : '' }}>居酒屋</option>
                <option value="ramen" {{ request('genre') == 'ラーメン' ? 'selected' : '' }}>ラーメン</option>
                <option value="italian" {{ request('genre') == 'イタリアン' ? 'selected' : '' }}>イタリアン</option>
            </select>
            <input type="text" class="search-bar" placeholder="Search ...">
            <button type="submit" class="btn btn-primary">検索</button>
        </form>
    </div>
</header>

<main>
    <!-- 検索結果が存在しない場合のメッセージ -->
    @if($restaurants->isEmpty())
        <p>該当する店舗はありません。</p>
    @else
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
    @endif
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
