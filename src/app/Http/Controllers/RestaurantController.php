<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    //飲食店一覧ページ表示
    public function index(Request $request)
    {
        $restaurants = Restaurant::query();

        // エリアフィルタ
        if ($request->has('area') && $request->area != 'all') {
            $restaurants->whereHas('prefecture', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->area . '%');
            });
        }

        // ジャンルフィルタ
        if ($request->has('genre') && $request->genre != 'all') {
            $restaurants->whereHas('genre', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->genre . '%');
            });
        }

        // 関連情報(prefecture, genre)も一緒に取得
        $restaurants = $restaurants->with(['prefecture', 'genre'])->get();

        // ビューに渡す
        return view('index', compact('restaurants'));
    }

    //飲食店詳細ページ表示
    public function detail($restaurant_id)
    {
        // 認証されていないユーザーの場合
        if (!Auth::check()) {
            return redirect()->route('register'); // 会員登録画面にリダイレクト
        }

        // 認証されている場合
        $restaurant = Restaurant::findOrFail($restaurant_id);
        return view('detail', compact('restaurant'));
    }
}
