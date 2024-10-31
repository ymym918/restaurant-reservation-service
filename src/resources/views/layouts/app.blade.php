<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a class="header__logo" href="/">
                    Rese
                </a>
                <nav>
                    <ul class="header-nav">
                    <!-- ログイン後に表示されるメニュー -->
                        @if (Auth::check())
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="/">Home</a>
                        </li>
                        <li class="header-nav__item">
                            <form class="form" action="/logout" method="post">
                                @csrf
                                <button class="header-nav__button">Logout</button>
                            </form>
                        </li>
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="/mypage">Mypage</a>
                        </li>
                        @else
                        <!-- ゲスト（ログインしていない場合）に表示されるメニュー -->
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="/">Home</a>
                        </li>
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="/register">Registration</a>
                        </li>
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="/login">Login</a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>
