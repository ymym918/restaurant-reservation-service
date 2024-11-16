<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        // バリデーションを通過したデータを取得
        $validated = $request->validated();

        // ユーザーを作成
        User::create($validated);

        // ユーザーをログアウト
        Auth::logout();

        // サンクスページへリダイレクト
        return redirect('/thanks');
    }
}
