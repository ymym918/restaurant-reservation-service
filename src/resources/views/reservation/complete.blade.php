@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/complete.css') }}">
@endsection

@section('content')
<body>
    <div class="container">
        <p class="message">ご予約ありがとうございます</p>
        <a href="/" class="button">戻る</a>
    </div>
</body>

@endsection
