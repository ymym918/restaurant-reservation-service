<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Reservation;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $restaurants = Restaurant::all();

        // ユーザーの予約情報を取得
        $reservations = Reservation::where('user_id', $user->id)->get();

        // ユーザーのお気に入り店舗を取得
        $favorites = Favorite::where('user_id', $user->id)->get();

        // ビューに変数を渡す
        return view('mypage', compact('user', 'restaurants', 'reservations', 'favorites'));
    }
}
