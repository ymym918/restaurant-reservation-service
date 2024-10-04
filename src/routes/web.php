<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;

//飲食店ページ表示
Route::get('/', [RestaurantController::class, 'index']);
