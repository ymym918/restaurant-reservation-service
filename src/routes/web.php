<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;

// ログインページへのアクセス（認証不要）
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

// ログイン処理（認証不要）
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

//飲食店ページ表示
Route::get('/', [RestaurantController::class, 'index'])->name('restaurant.index');

// ログイン後に表示するトップページ
Route::middleware('auth')->group(function () {
    Route::get('/', [AuthenticatedSessionController::class, 'index'])->name('restaurant.index');
});

//飲食店詳細ページ表示
Route::get('/detail/{restaurant_id}', [RestaurantController::class, 'detail'])->name('restaurant.detail');

//予約フォームから送信されたデータの保存
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
