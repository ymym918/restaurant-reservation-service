<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // お気に入り追加
    public function create($restaurant_id)
    {
        $user = Auth::user();

        // すでにお気に入りに追加されているか確認
        if (!$user->favorites()->where('restaurant_id', $restaurant_id)->exists()) {
            // 多対多リレーションの中間テーブルにレコードを追加
            $user->favorites()->create($restaurant_id);
        }

        return redirect()->back()->with('success', 'お気に入りに追加しました。');
    }

    // お気に入り削除メソッド
    public function delete($restaurant_id)
    {
        $user = Auth::user();

        // お気に入りのレコードを取得し、存在する場合は削除
        $user->favorites()->delete($restaurant_id);

        return redirect()->back()->with('success', 'お気に入りを削除しました。');
    }
}
