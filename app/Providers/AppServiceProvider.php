<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Integrations\DaData\Connector as DaDataConnector;

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
        DaDataConnector::bootConnection($this->app);
    }
}
