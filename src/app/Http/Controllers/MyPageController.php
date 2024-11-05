<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

class MyPageController extends Controller
{
    public function index()
    {
        // 現在のログインユーザーを取得
        $user = Auth::user();

        // ユーザーの予約情報を取得
        $reservations = Reservation::where('user_id', $user->id)->get();

        // ビューに変数を渡す
        return view('mypage', compact('user', 'reservations'));
    }
}
