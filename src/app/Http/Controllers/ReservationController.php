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

        // 予約完了ページへリダイレクト
        return redirect()->route('reservation.complete');
    }

    // 予約完了後、予約完了ページへリダイレクト
    public function complete()
    {
        return view('reservation.complete');
    }

    // 予約変更ページを表示
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);

        // 関連するレストラン情報を取得
        $restaurant = $reservation->restaurant;

        // 予約が現在のユーザーのものであるか確認
        if (auth()->id() !== $reservation->user_id) {
            abort(403); // 権限がない場合、403エラー
        }

        // ビューに予約とレストランのデータを渡す
        return view('reservation.edit', compact('reservation', 'restaurant'));
    }

    // 更新処理用のメソッド
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        // バリデーション
        $request->validate([
            'reservation_date' => 'required|date',
            'reservation_time' => 'required|date_format:H:i',
            'number_of_people' => 'required|integer|min:1',
        ]);

        // 予約が現在のユーザーのものであるか確認（必要に応じて）
        if (auth()->id() !== $reservation->user_id) {
            abort(403); // 権限がない場合、403エラー
        }

        // データの更新
        $reservation->update([
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time,
            'number_of_people' => $request->number_of_people,
        ]);

        return redirect()->route('mypage')->with('success', '予約情報が更新されました');
    }
}
