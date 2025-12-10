<?php

namespace App\Providers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

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
        UserResource::withoutWrapping();

        RateLimiter::for('api', function (Request $request) {
        return $request->user() ?
        Limit::perMinute(60) :
        Limit::perMinute(10)->by($request->ip());
    });

    }
}
