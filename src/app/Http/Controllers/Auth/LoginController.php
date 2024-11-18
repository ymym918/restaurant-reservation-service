<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
/**
 * ログインビューを表示する
 *
 * @return \Illuminate\View\View
 */
    public function loginView()
    {
        return view('auth.login'); // ログインページのビュー
    }

/** ログイン処理
 * @param \App\Http\Requests\LoginRequest $request
* @return \Illuminate\Http\RedirectResponse
*/
    public function login(LoginRequest $request)
    {
        // フォームリクエストでバリデーションを実施
        $credentials = $request->only('email', 'password');

        // ユーザー認証
        if (Auth::attempt($credentials)) {

        // ログイン成功後、ホーム画面へ遷移
        return redirect('/');

        // ログイン失敗
        return back()->withErrors([
            'email' => 'ご入力内容が登録情報と一致しません。',]);
        }
    }

/**
* ログアウト処理
*/
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
