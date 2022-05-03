<?php
declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\Usecases\GetTwitterLikeList\GetTwitterLikeListInterface;
use App\Interfaces\Usecases\GetUserInfo\GetUserInfoInterface;
use App\Interfaces\Usecases\Signin\GetRedirectUrlInterface;
use App\Interfaces\Usecases\Signin\SigninAuthUserInterface;
use App\Interfaces\Usecases\Signout\SignoutInterface;
use App\Usecases\GetTwitterLikeList\GetTwitterLikeList;
use App\Usecases\GetUserInfo\GetUserInfo;
use App\Usecases\Signin\GetRedirectUrl;
use App\Usecases\Signin\SigninAuthUser;
use App\Usecases\Signout\Signout;
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
        $this->app->singleton(SignoutInterface::class, Signout::class);
        $this->app->singleton(GetUserInfoInterface::class, GetUserInfo::class);
        $this->app->singleton(GetTwitterLikeListInterface::class, GetTwitterLikeList::class);
    }
}
