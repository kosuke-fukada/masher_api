<?php
declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\Services\Signin\SetAuthSessionServiceInterface;
use App\Services\Signin\SetAuthSessionService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SetAuthSessionServiceInterface::class, SetAuthSessionService::class);
    }
}
