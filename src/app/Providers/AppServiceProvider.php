<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Actions\Fortify\LogoutResponse;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(LogoutResponseContract::class, LogoutResponse::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
