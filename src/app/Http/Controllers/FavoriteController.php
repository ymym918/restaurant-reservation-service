<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // お気に入り登録
    public function addFavorite(Request $request, $restaurantId)
    {
        $user = Auth::user();
        $restaurant = Restaurant::findOrFail($restaurantId);

        // お気に入りが既に存在する場合は論理削除されている場合もあるので、探す
        $favorite = Favorite::withTrashed()
            ->where('user_id', $user->id)
            ->where('restaurant_id', $restaurant->id)
            ->first();

        if ($favorite) {
            // もし論理削除されていたら復活させる
            if ($favorite->trashed()) {
                $favorite->restore();
            }
        } else {
            // 新規にお気に入りを追加
            Favorite::create([
                'user_id' => $user->id,
                'restaurant_id' => $restaurant->id,
            ]);
        }

        return response()->json(['status' => 'success']);
    }

    // お気に入り削除
    public function removeFavorite(Request $request, $restaurantId)
    {
        $user = Auth::user();
        $restaurant = Restaurant::findOrFail($restaurantId);

        // 論理削除
        $favorite = Favorite::where('user_id', $user->id)
            ->where('restaurant_id', $restaurant->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
        }

        return response()->json(['status' => 'success']);
    }
}
