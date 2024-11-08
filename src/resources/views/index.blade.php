@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<body>
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
                    <a href="{{ route('restaurant.detail', $restaurant->id) }}" >詳しく見る</a>
                    <span class="favorite" onclick="toggleFavorite(this, {{ $restaurant->id }})">
                        @if ($restaurant->isFavoritedBy(Auth::user()))
                        &#x2665; <!-- 塗りつぶしのハート (お気に入り済み) -->
                        @else
                        &#x2661; <!-- 空のハート (未お気に入り) -->
                        @endif
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </main>

    <script>
    function toggleFavorite(element, restaurantId) {
        element.classList.toggle('active');

        // ハートの中身を切り替え (塗りつぶし or 空)
        if (element.classList.contains('active')) {
            element.innerHTML = '&#x2665;'; // 塗りつぶしのハート (赤)
            addFavorite(restaurantId); // お気に入り追加
        } else {
            element.innerHTML = '&#x2661;'; // 空のハート (グレー)
            removeFavorite(restaurantId); // お気に入り削除
        }
    }

    function addFavorite(restaurantId) {
        fetch(`/like/${restaurantId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRFトークンの設定
            },
            body: JSON.stringify({ restaurant_id: restaurantId })
        })
        .then(response => response.json())
        .then(data => {
            console.log('お気に入り追加:', data);
        })
        .catch(error => console.error('エラー:', error));
    }

    function removeFavorite(restaurantId) {
        fetch(`/unlike/${restaurantId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRFトークンの設定
            },
            body: JSON.stringify({ restaurant_id: restaurantId })
        })
        .then(response => response.json())
        .then(data => {
            console.log('お気に入り削除:', data);
        })
        .catch(error => console.error('エラー:', error));
    }
</script>

</body>

@endsection
