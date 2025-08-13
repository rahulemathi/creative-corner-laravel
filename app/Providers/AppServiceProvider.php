<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
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
        // Register blade directive for admin checks
        Blade::if('admin', function () {
            return Auth::check() && Auth::user()->isAdmin();
        });

        Blade::if('notadmin', function () {
            return !Auth::check() || !Auth::user()->isAdmin();
        });
    }
}
