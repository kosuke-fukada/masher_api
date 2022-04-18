<?php
declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\Usecases\Signin\GetRedirectUrlInterface;
use App\Interfaces\Usecases\Signin\SigninAuthUserInterface;
use App\Usecases\Signin\GetRedirectUrl;
use App\Usecases\Signin\SigninAuthUser;
use Illuminate\Support\ServiceProvider;

class UsecaseServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(SigninAuthUserInterface::class, SigninAuthUser::class);
        $this->app->singleton(GetRedirectUrlInterface::class, GetRedirectUrl::class);
    }
}
