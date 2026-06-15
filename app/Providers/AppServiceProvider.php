<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Fitur ini bakal otomatis nyala cuma kalau APP_URL di .env pakai "https"
        if (str_contains(env('APP_URL'), 'https://')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}