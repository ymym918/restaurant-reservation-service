@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="restaurant-detail">
    <div class="restaurant-detail-header">
        <a href="{{ route('restaurant.index') }}">＜</a>
        <h2>{{ $restaurant->name }}</h2>
    </div>
    <img src="{{ $restaurant->image_path }}" alt="{{ $restaurant->name }}">
    <p>#{{ $restaurant->prefecture->name }} #{{ $restaurant->genre->name }}</p>
    <p>{{ $restaurant->description }}</p>
</div>
@endsection

    {{-- <div class="reservation-form">
        <h3>予約</h3>
        <form action="{{ route('reservation.store') }}" method="POST">
            @csrf
            <label for="date">日付:</label>
            <input type="date" name="date" id="date" required>

            <label for="time">時間:</label>
            <select name="time" id="time" required>
                <option value="17:00">17:00</option>
                <option value="18:00">18:00</option>
                <!-- 他の時間も追加 -->
            </select>

            <label for="people">人数:</label>
            <select name="people" id="people" required>
                <option value="1">1人</option>
                <option value="2">2人</option>
                <!-- 他の人数も追加 -->
            </select>

            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

            <button type="submit">予約する</button>
        </form> --}}
    {{-- </div> --}}
