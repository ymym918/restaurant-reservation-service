<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

class MyPageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ユーザーの予約情報を取得
        $reservations = Reservation::where('user_id', $user->id)->get();

        // ビューに変数を渡す
        return view('mypage', compact('user', 'reservations'));
    }

    public function delete(Reservation $reservation)
    {
        // 予約がログインユーザーのものであるか確認
        if ($reservation->user_id == Auth::id()) {
            // 予約を削除
            $reservation->delete();
        }

        // 予約削除後、マイページにリダイレクト
        return redirect()->route('mypage')->with('success', '予約を削除しました。');
    }
}
