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

<form action="{{ route('register') }}" method="post">
    @csrf
    <div class="form__content">
        <div class="form__item">
            <input class="form__input" type="text" name="name" placeholder="Username" value="{{ old('name') }}" />
        </div>
        <div class="form__error">
            @error('name')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form__content">
            <div class="form__item">
                <input class="form__input" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            </div>
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
        </div>
        <div class="form__content">
            <div class="form__item">
            <input class="form__input" type="password" name="password" placeholder="Password">
        </div>
        <div class="form__error">
            @error('password')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form__item form__item-button">
        <button class="form__input form__input-button" type="submit">登録</button>
    </div>
</form>
@endsection
