<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Tests\SQLiteTestingConnector;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('db.connector.sqlite', SQLiteTestingConnector::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
