<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\FavoriteController;

//飲食店一覧ページ表示
Route::get('/', [RestaurantController::class, 'index'])->name('restaurant.index');

// 会員登録ページ表示
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

// 会員登録情報の保存
Route::post('/register', [RegisteredUserController::class, 'store']);

//サンクスページ表示
Route::get('/thanks', function () {return view('thanks');})->name('thanks');

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
Route::delete('/reservation/{reservation_id}', [MyPageController::class, 'delete'])->name('reservation.delete');

// お気に入り飲食店を保存
Route::post('/like/{restaurant_id}', [FavoriteController::class, 'create'])->name('like');

// お気に入り飲食店を削除
Route::post('/unlike/{restaurant_id}', [FavoriteController::class, 'delete'])->name('unlike');
