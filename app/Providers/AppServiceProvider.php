<?php

namespace App\Providers;

use App\Observers\ThingObserver;
use App\Thing;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Thing::observe(ThingObserver::class);
    }
}
