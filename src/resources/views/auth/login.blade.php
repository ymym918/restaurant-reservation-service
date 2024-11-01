@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
    @if (session('message'))
        <div class="login-error__message">
            <span class="login-error__message-text">{{ session('message') }}</span>
        </div>
    @endif
    <div class="header__wrap">
        <span class="header__text">
            Login
        </span>
    </div>

    <form class="form__wrap" action="/login" method="post">
        @csrf
        <div class="form__item">
            <input class="form__input" type="email" name="email" placeholder="Email">
        </div>
        <div class="error__item">
            @error('email')
                <span class="error__message">{{ $message }}</span>
            @enderror
        </div>
        <div class="form__item">
            <input class="form__input password__input" type="password" name="password" placeholder="Password">
        </div>
        <div class="error__item">
            @error('password')
                <span class="error__message">{{ $message }}</span>
            @enderror
            </div>
        <div class="form__item form__item-button">
            <button class="form__input-button" type="submit">ログイン</button>
        </div>
    </form>

@endsection
