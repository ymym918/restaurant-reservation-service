@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<body>
    <main>
        <div class="thanks__content">
            <p>会員登録ありがとうございます</p>
            <a class="text-center" href="/login">
                <button class="button-submit" type="button">ログインする</button>
            </a>
            </a>
        </div>
    </main>
</body>

@endsection
