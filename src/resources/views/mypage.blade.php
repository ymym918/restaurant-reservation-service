@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="header__wrap">
        <p class="header__text">
            {{ \Auth::user()->name }}さんお疲れ様です！
        </p>
    </div>

@if (session('error'))
    <div class="alert_danger">
        {{ session('error') }}
    </div>
@endif

<body>
<div class="container">
    {{-- 勤務開始 --}}
    <form class="form__work" action="{{route('work.start')}}" method="post">
        @csrf
        <div class="form__item">
            <button class="form__item-button" type="submit" name="start_work">勤務開始
            </button>
        </div>
    </form>

    {{-- 勤務終了 --}}
    <form class="form__work" action="{{route('work.end')}}" method="post">
        @csrf
        <div class="form__item">
            <button class="form__item-button" type="submit" name="end_work">勤務終了
            </button>
        </div>
    </form>

    {{-- 休憩開始 --}}
    <form class="form__start-rest" action="{{route('rest.start')}}" method="post">
        @csrf
        <div class="form__item">
            <button class="form__item-button" type="submit" name="start_work">休憩開始
            </button>
        </div>
    </form>

    {{-- 休憩終了 --}}
    <form class="form__end-rest" action="{{route('rest.end')}}" method="post">
        @csrf
        <div class="form__item">
            <button class="form__item-button" type="submit" name="end_rest">休憩終了
            </button>
        </div>
    </form>
</div>
</body>
@endsection
