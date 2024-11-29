<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Http\Request;


class ReviewController extends Controller
{
    public function create($reservation_id)
    {
        $reservation = Reservation::with('restaurant')->findOrFail($reservation_id);
        return view('reviews.create', compact('reservation'));
    }

    public function store(Request $request, $reservation_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:200',
            'reservation_id' => 'required|exists:reservations,id',
        ]);

        $userId = auth()->id();

        $reservation = Reservation::findOrFail($request->reservation_id);

        Review::create([
            'user_id' => $userId,
            'restaurant_id' => $reservation->restaurant_id,
            'reservation_id' => $request->reservation_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // 予約を論理削除
        $reservation->delete();

        return redirect()->route('mypage')->with('success', 'レビューを投稿しました。予約情報は削除されました。');
    }
}
