<?php

namespace App\Http\Controllers;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    //飲食店一覧ページ表示
    public function index()
    {
        $restaurants = Restaurant::with(['prefecture', 'genre'])->get();
        return view('index', compact('restaurants'));
    }

    //飲食店詳細ページ表示
    public function detail($restaurant_id)
    {
        // 認証されていないユーザーの場合
        if (!Auth::check()) {
            return redirect()->route('register'); // 会員登録画面にリダイレクト
        }

        // 認証されている場合のロジック
        $restaurant = Restaurant::findOrFail($restaurant_id);
        return view('detail', compact('restaurant'));
    }
}
