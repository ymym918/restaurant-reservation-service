<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LogoutResponse;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        // 会員登録時のユーザー作成処理を定義
        Fortify::createUsersUsing(CreateNewUser::class);

        // 会員登録ページの表示
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // ログインページの表示
        Fortify::loginView(function () {
            return view('auth.login');
        });

        RateLimiter::for('login', function () {
            return Limit::perMinute(100); // 1分あたり100回のリクエストを許可
        });
    }
}
