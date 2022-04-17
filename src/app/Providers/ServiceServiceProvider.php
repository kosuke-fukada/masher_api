<?php
declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\Services\Signin\SigninUserServiceInterface;
use App\Services\Signin\SigninUserService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SigninUserServiceInterface::class, SigninUserService::class);
    }
}
