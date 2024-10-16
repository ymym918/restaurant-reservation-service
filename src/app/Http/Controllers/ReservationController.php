<?php

namespace App\Http\Controllers;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        // フォームから送信されたデータをバリデーション
        $validatedData = $request->validate([
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'number_of_people' => 'required|integer|min:1',
        ]);

        // 新しい予約を作成
        Reservation::create([
            // 'user_id' => auth()->id(),
            'restaurant_id' => $request->restaurant_id,
            'reservation_date' => $validatedData['reservation_date'],
            'reservation_time' => $validatedData['reservation_time'],
            'number_of_people' => $validatedData['number_of_people'],
        ]);

        return redirect()->back()->with('success', '予約が完了しました');
    }
}

