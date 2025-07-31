<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use LaravelFrontendPresets\ArgonPreset\ArgonPreset;
use LaravelFrontendPresets\ArgonPreset\ArgonPresetServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->environment('local')) {
            error_reporting(E_ALL & ~E_USER_DEPRECATED);
        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
