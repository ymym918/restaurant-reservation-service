<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;

//飲食店一覧ページ表示
Route::get('/', [RestaurantController::class, 'index'])->name('restaurant.index');

// 検索機能(カテゴリー検索とキーワード検索)
Route::get('/restaurants/search', [RestaurantController::class, 'search'])->name('restaurants.search');

// 会員登録ページ表示
Route::get('/register', [RegisteredUserController::class, 'index'])->name('register.index');

// 会員登録情報の追加
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

//サンクスページ表示
Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');

// ログイン画面表示
Route::get('login', [LoginController::class, 'loginView'])->name('login');

// ログインフォーム送信時
Route::post('login', [LoginController::class, 'login']);

// ログアウト
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

//飲食店詳細ページ表示
Route::get('/detail/{restaurant_id}', [RestaurantController::class, 'detail'])->name('restaurant.detail');

//予約フォームから送信されたデータの保存
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');

//予約完了後、予約完了ページ表示
Route::get('/done',[ReservationController::class, 'complete'])->name('reservation.complete');

// マイページ表示
Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage');

// 予約変更ページ表示
Route::get('/reservation/{reservation_id}/edit', [ReservationController::class, 'edit'])->name('reservation.edit');

// 予約を変更
Route::put('/reservation/{reservation_id}', [ReservationController::class, 'update'])->name('reservation.update');

// 予約を削除
Route::delete('/reservation/{reservation_id}', [ReservationController::class, 'softDelete'])->name('reservation.softDelete');

// お気に入りの追加
Route::post('/like/{restaurantId}', [FavoriteController::class, 'addFavorite'])->name('favorite.add');

// お気に入りの削除
Route::delete('/like/{restaurantId}', [FavoriteController::class, 'removeFavorite'])->name('favorite.remove');

// 評価情報の取得
Route::get('reviews/{reservation_id}/create', [ReviewController::class, 'create'])->name('reviews.create');

// 評価情報の保存
Route::post('/reviews/store/{reservation_id}', [ReviewController::class, 'store'])->name('reviews.store');

