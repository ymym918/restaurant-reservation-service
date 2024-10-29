@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<body>
    <main>
        <div class="thanks__content">
            <h3>会員登録ありがとうございます</h3>
            <a class="text-center" href="/rogin">
                <button class="form__button-submit" type="submit">ログインする</button>
            </a>
        </div>
    </main>
</body>

@endsection
