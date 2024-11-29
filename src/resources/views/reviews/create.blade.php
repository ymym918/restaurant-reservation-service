@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
<h2>{{ $reservation->restaurant->name }}のレビュー投稿</h2>
<img src="{{ $reservation->restaurant->image_path }}" alt="{{ $reservation->restaurant->name }}">

<form method="POST" action="{{ route('reviews.store', $reservation->id) }}">
    @csrf
    <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">

    <label for="rating">評価 (1〜5):</label>
    <select name="rating" id="rating" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>

    <label for="comment">コメント:</label>
    <textarea name="comment" id="comment" rows="4" required></textarea>

    <button type="submit">投稿</button>
</form>

@endsection

