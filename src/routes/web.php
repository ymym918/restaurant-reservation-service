<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\RegisteredUserController;

// 会員登録ページ表示
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

// 会員登録情報の保存
Route::post('/register', [RegisteredUserController::class, 'store']);

//サンクスページ表示
Route::get('/thanks', function () {return view('thanks');})->name('thanks');

//飲食店ページ表示
Route::get('/', [RestaurantController::class, 'index'])->name('restaurant.index');

//飲食店詳細ページ表示
Route::get('/detail/{restaurant_id}', [RestaurantController::class, 'detail'])->name('restaurant.detail');

//予約フォームから送信されたデータの保存
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');

//予約完了後、予約完了ページ表示
Route::get('/done',[ReservationController::class, 'complete'])->name('reservation.complete');

