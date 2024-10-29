<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;

// 会員登録後のサンクスページ表示
Route::get('/thanks', function () {return view('thanks');})->name('thanks');

//飲食店ページ表示
Route::get('/', [RestaurantController::class, 'index'])->name('restaurant.index');

//飲食店詳細ページ表示
Route::get('/detail/{restaurant_id}', [RestaurantController::class, 'detail'])->name('restaurant.detail');

//予約フォームから送信されたデータの保存
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
