<?php
declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\Usecases\GetTweet\GetTweetInterface;
use App\Interfaces\Usecases\GetTwitterLikeList\GetTwitterLikeListInterface;
use App\Interfaces\Usecases\GetUserInfo\GetUserInfoInterface;
use App\Interfaces\Usecases\RefreshTwitterAccessToken\RefreshTwitterAccessTokenInterface;
use App\Interfaces\Usecases\CreateLikeCount\CreateLikeCountInterface;
use App\Interfaces\Usecases\Signin\GetRedirectUrlInterface;
use App\Interfaces\Usecases\Signin\SigninAuthUserInterface;
use App\Interfaces\Usecases\Signout\SignoutInterface;
use App\Usecases\GetTweet\GetTweet;
use App\Usecases\GetTwitterLikeList\GetTwitterLikeList;
use App\Usecases\GetUserInfo\GetUserInfo;
use App\Usecases\RefreshTwitterAccessToken\RefreshTwitterAccessToken;
use App\Usecases\CreateLikeCount\CreateLikeCount;
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
        $this->app->singleton(RefreshTwitterAccessTokenInterface::class, RefreshTwitterAccessToken::class);
        $this->app->singleton(GetTweetInterface::class, GetTweet::class);
        $this->app->singleton(CreateLikeCountInterface::class, CreateLikeCount::class);
    }
}
