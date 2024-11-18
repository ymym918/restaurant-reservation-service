<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fortifyのデフォルトログイン処理を無効化
        Fortify::loginView(function () {
            return view('auth.login'); // カスタムログインビュー
        });

        // デフォルトの認証処理を無効化
        Fortify::authenticateUsing(function ($request) {
            return null; // デフォルトの認証処理を無効化
        });
    }
}
