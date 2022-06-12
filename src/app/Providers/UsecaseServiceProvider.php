<?php
declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\Usecases\Inquiry\PostInquiry\PostInquiryInterface;
use App\Usecases\User\Signout\Signout;
use Illuminate\Support\ServiceProvider;
use App\Usecases\Tweet\GetTweet\GetTweet;
use App\Usecases\User\GetUserInfo\GetUserInfo;
use App\Usecases\User\GetRedirectUrl\GetRedirectUrl;
use App\Usecases\User\SigninAuthUser\SigninAuthUser;
use App\Usecases\Like\CreateLikeCount\CreateLikeCount;
use App\Usecases\Like\UpdateLikeCount\UpdateLikeCount;
use App\Interfaces\Usecases\User\Signout\SignoutInterface;
use App\Interfaces\Usecases\Tweet\GetTweet\GetTweetInterface;
use App\Usecases\Tweet\GetTwitterLikeList\GetTwitterLikeList;
use App\Interfaces\Usecases\User\GetUserInfo\GetUserInfoInterface;
use App\Interfaces\Usecases\User\GetRedirectUrl\GetRedirectUrlInterface;
use App\Interfaces\Usecases\User\SigninAuthUser\SigninAuthUserInterface;
use App\Interfaces\Usecases\Like\CreateLikeCount\CreateLikeCountInterface;
use App\Interfaces\Usecases\Like\GetLikeCount\GetLikeCountInterface;
use App\Interfaces\Usecases\Like\UpdateLikeCount\UpdateLikeCountInterface;
use App\Usecases\User\RefreshTwitterAccessToken\RefreshTwitterAccessToken;
use App\Interfaces\Usecases\Tweet\GetTwitterLikeList\GetTwitterLikeListInterface;
use App\Interfaces\Usecases\User\GetTwitterUser\GetTwitterUserInterface;
use App\Interfaces\Usecases\User\RefreshTwitterAccessToken\RefreshTwitterAccessTokenInterface;
use App\Usecases\Inquiry\PostInquiry\PostInquiry;
use App\Usecases\Like\GetLikeCount\GetLikeCount;
use App\Usecases\User\GetTwitterUser\GetTwitterUser;

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
        $this->app->singleton(UpdateLikeCountInterface::class, UpdateLikeCount::class);
        $this->app->singleton(GetLikeCountInterface::class, GetLikeCount::class);
        $this->app->singleton(GetTwitterUserInterface::class, GetTwitterUser::class);
        $this->app->singleton(PostInquiryInterface::class, PostInquiry::class);
    }
}
