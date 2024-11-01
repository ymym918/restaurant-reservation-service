<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        // ログインユーザーIDを取得
        $userId = auth()->id();

        // Reservationモデルを使用して新しい予約を作成
        Reservation::create([
            'user_id' => $userId,
            'restaurant_id' => $request->restaurant_id,
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time,
            'number_of_people' => $request->number_of_people,
        ]);

        // 予約完了ページにリダイレクト
        return redirect()->route('done.index');
    }
}
