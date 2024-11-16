@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="header__wrap">
    <span class="header__text">
        Registration
    </span>
</div>

<form action="{{ route('register.store') }}" method="post" autocomplete="on">
    @csrf
    <div class="form__wrap">
        <div class="form__item">
            <input class="form__input" type="text" name="name" placeholder="Username" value="{{ old('name') }}" autocomplete="name" />
        </div>
        <div class="form__error">
            @error('name')
            {{ $message }}
            @enderror
        </div>

        <div class="form__item">
            <input class="form__input" type="email" name="email" placeholder="Email" value="{{ old('email') }}" autocomplete="email">
        </div>
        <div class="form__error">
            @error('email')
            {{ $message }}
            @enderror
        </div>

        <div class="form__item">
            <input class="form__input" type="password" name="password" placeholder="Password" autocomplete="new-password">
        </div>
        <div class="form__error">
            @error('password')
            {{ $message }}
            @enderror
        </div>

        <div class="form__item form__item-button">
            <button class="form__input form__input-button" type="submit">登録</button>
        </div>
    </div>
</form>

@endsection
