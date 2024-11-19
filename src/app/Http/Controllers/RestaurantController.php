<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Genre;
use App\Models\Prefecture;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    //飲食店一覧ページ表示
    public function index(Request $request)
    {
        $restaurants = Restaurant::query();

        // 関連情報(prefecture, genre)も一緒に取得
        $restaurants = $restaurants->with(['prefecture', 'genre'])->get();

        // 検索条件が指定されていた場合
        if ($request->has('prefecture') || $request->has('genre') || $request->has('keyword')) {
            return $this->search($request);
        }

        // $prefectures と $genres をビューに渡す
        $prefectures = Prefecture::all();
        $genres = Genre::all();

        return view('index', compact('restaurants', 'prefectures', 'genres'));
    }

    //飲食店詳細ページ表示
    public function detail($restaurant_id)
    {
        // 認証されていないユーザーの場合
        if (!Auth::check()) {

        // 会員登録画面にリダイレクト
            return redirect()->route('register.index');
        }

        // 認証されている場合
        $restaurant = Restaurant::findOrFail($restaurant_id);
        return view('detail', compact('restaurant'));
    }

    public function search(Request $request)
    {
        // 検索に必要なジャンルと都道府県を全て取得
        $prefectures = Prefecture::all();
        $genres = Genre::all();

        // 選択された検索条件から該当する飲食店情報を取得
        $restaurants = Restaurant::with(['prefecture', 'genre'])
        ->PrefectureSearch($request->prefecture)
        ->GenreSearch($request->genre)
        ->KeywordSearch($request->keyword)
        ->get();

        // 検索結果が空の場合にメッセージを設定
        $noResultsMessage = $restaurants->isEmpty() ? '該当する飲食店が見つかりませんでした' : null;

        return view('index', compact('restaurants', 'prefectures', 'genres', 'noResultsMessage'));
    }
}
