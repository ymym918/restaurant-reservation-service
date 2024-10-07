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
                    <span class="favorite" onclick="toggleFavorite(this)">&#x2661;</span>
                </div>

                <script>
                    function toggleFavorite(element) {
                        element.classList.toggle('active');
                        // ハートの中身を切り替え (塗りつぶし or 空)
                        if (element.classList.contains('active')) {
                            element.innerHTML = '&#x2665;'; // 塗りつぶしのハート (赤)
                        } else {
                            element.innerHTML = '&#x2661;'; // 空のハート (グレー)
                        }
                    }
                </script>
            </div>
            @endforeach
        </div>
    </main>
</body>

</html>
@endsection
