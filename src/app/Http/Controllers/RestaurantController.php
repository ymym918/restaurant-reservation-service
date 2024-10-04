<?php

namespace App\Http\Controllers;
use App\Models\Restaurant;
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
    public function detail()
    {
        $restaurants = Restaurant::with(['prefecture', 'genre'])->get();
        return view('detail', compact('restaurants'));
    }
}
