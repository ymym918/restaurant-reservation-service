<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hamburger-menu.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a class="header__logo" href="/">
                    Rese
                </a>
                <!-- ハンバーガーメニューとドロワーメニュー -->
                <div class="menu-icon" onclick="toggleDrawerMenu()">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
        <!-- ドロワーメニュー -->
        <div class="drawer-menu" id="drawerMenu">
            <ul>
                @auth
                <li><a href="/">Home</a></li>
                <li><a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <li><a href="/mypage">Mypage</a></li>
                @else
                <li><a href="/">Home</a></li>
                <li><a href="/register">Registration</a></li>
                <li><a href="/login">Login</a></li>
                @endauth
            </ul>
        </div>
    </main>
</body>
</html>

{{-- ハンバーガーメニュー用のJSコード --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const hamburgerMenu = document.getElementById("hamburger-menu");
        const drawerMenu = document.getElementById("drawer-menu");

        hamburgerMenu.addEventListener("click", function() {
            drawerMenu.classList.toggle("show");
        });
    });

    function openDrawerMenu() {
        document.getElementById("drawerMenu").classList.add("show");
    }

    function closeDrawerMenu() {
        document.getElementById("drawerMenu").classList.remove("show");
    }

    function toggleDrawerMenu() {
        // メニューアイコンとドロワーメニューの要素を取得
        const menuIcon = document.querySelector('.menu-icon');
        const drawerMenu = document.getElementById('drawerMenu');

        // activeクラスを切り替え
        menuIcon.classList.toggle('active');
        drawerMenu.classList.toggle('show');
    }
</script>
