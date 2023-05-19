<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CurrencyService;
class CurrencyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('currency', function ($app) {
            return new CurrencyService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
