<?php

namespace App\Providers;

use App\Contracts\CounterContract;
use App\Services\Counter;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Cache\Factory as Cache;
use Illuminate\Contracts\Session\Session;

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
        $this->app->singleton(CounterContract::class, function ($app) {
            return new Counter($app->make('Illuminate\Contracts\Cache\Factory'), $app->make('Illuminate\Contracts\Session\Session'), 1);
        });

    }
}
