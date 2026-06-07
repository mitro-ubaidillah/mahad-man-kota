<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->canManageAttendance();
        });

        Blade::if('superAdmin', function () {
            return auth()->check() && auth()->user()->isSuperAdmin();
        });

        Blade::if('articleAdmin', function () {
            return auth()->check() && auth()->user()->canManageArticles();
        });
    }
}
