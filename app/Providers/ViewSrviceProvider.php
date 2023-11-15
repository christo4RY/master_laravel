<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\View\Composers\ActivityComposer;
class ViewSrviceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer(['blog.index','blog.show'], ActivityComposer::class);
    }
}
