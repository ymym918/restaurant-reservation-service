<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function create($restaurant_id)
    {
        $user_id = Auth::id();

        // 既にお気に入り登録されていない場合のみ追加
        $favorite = Favorite::firstOrCreate([
            'user_id' => $user_id,
            'restaurant_id' => $restaurant_id,
        ]);

        return response()->json(['success' => true]);
    }

    public function removeFavorite($restaurantId)
    {
        $user = auth()->user();

        // 飲食店のお気に入りを論理削除
        $favorite = Favorite::where('user_id', $user->id)
            ->where('restaurant_id', $restaurantId)
            ->first();

        if ($favorite) {
            $favorite->delete(); // 論理削除
        }

        return response()->json(['success' => true]);
    }
}
