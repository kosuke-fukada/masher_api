<?php
declare(strict_types=1);

namespace App\Providers;

use App\Clients\GuzzleClient;
use App\Clients\PsrFactories;
use Illuminate\Support\Facades\App;
use Nyholm\Psr7\Factory\Psr17Factory;
use Illuminate\Support\ServiceProvider;
use App\Clients\GetTweet\GetTweetApiClient;
use Tests\Mock\Clients\GetTweet\GetTweetApiClientMock;
use App\Clients\GetTwitterUser\GetTwitterUserApiClient;
use App\Clients\GetTwitterLikeList\GetTwitterLikeListApiClient;
use App\Clients\GetTwitterUserById\GetTwitterUserByIdApiClient;
use App\Interfaces\Clients\GetTweet\GetTweetApiClientInterface;
use Tests\Mock\Clients\GetTwitterUser\GetTwitterUserApiClientMock;
use Tests\Mock\Clients\GetTwitterLikeList\GetTwitterLikeListApiClientMock;
use Tests\Mock\Clients\GetTwitterUserById\GetTwitterUserByIdApiClientMock;
use App\Interfaces\Clients\GetTwitterUser\GetTwitterUserApiClientInterface;
use App\Clients\RefreshTwitterAccessToken\RefreshTwitterAccessTokenApiClient;
use App\Interfaces\Clients\GetTwitterLikeList\GetTwitterLikeListApiClientInterface;
use App\Interfaces\Clients\GetTwitterUserById\GetTwitterUserByIdApiClientInterface;
use Tests\Mock\Clients\RefreshTwitterAccessToken\RefreshTwitterAccessTokenApiClientMock;
use App\Interfaces\Clients\RefreshTwitterAccessToken\RefreshTwitterAccessTokenApiClientInterface;

class ClientServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        if (App::environment('testing')) {
            $this->app->singleton(GetTwitterLikeListApiClientInterface::class, GetTwitterLikeListApiClientMock::class);
            $this->app->singleton(RefreshTwitterAccessTokenApiClientInterface::class, RefreshTwitterAccessTokenApiClientMock::class);
            $this->app->singleton(GetTweetApiClientInterface::class, GetTweetApiClientMock::class);
            $this->app->singleton(GetTwitterUserApiClientInterface::class, GetTwitterUserApiClientMock::class);
            $this->app->singleton(GetTwitterUserByIdApiClientInterface::class, GetTwitterUserByIdApiClientMock::class);
        } else {
            $this->app->singleton(GetTwitterLikeListApiClientInterface::class, function() {
                $factory = new Psr17Factory();
                $psrFactories = new PsrFactories(
                    $factory,
                    $factory,
                    $factory,
                    $factory
                );
                return new GetTwitterLikeListApiClient(
                    $psrFactories->uriFactory()->createUri(config('client.api.twitter.base_url')),
                    new GuzzleClient(),
                    $psrFactories
                );
            });
            $this->app->singleton(RefreshTwitterAccessTokenApiClientInterface::class, function() {
                $factory = new Psr17Factory();
                $psrFactories = new PsrFactories(
                    $factory,
                    $factory,
                    $factory,
                    $factory
                );
                return new RefreshTwitterAccessTokenApiClient(
                    $psrFactories->uriFactory()->createUri(config('client.api.twitter.base_url')),
                    new GuzzleClient(),
                    $psrFactories
                );
            });
            $this->app->singleton(GetTweetApiClientInterface::class, function() {
                $factory = new Psr17Factory();
                $psrFactories = new PsrFactories(
                    $factory,
                    $factory,
                    $factory,
                    $factory
                );
                return new GetTweetApiClient(
                    $psrFactories->uriFactory()->createUri(config('client.api.twitter_oembed.base_url')),
                    new GuzzleClient(),
                    $psrFactories
                );
            });
            $this->app->singleton(GetTwitterUserApiClientInterface::class, function() {
                $factory = new Psr17Factory();
                $psrFactories = new PsrFactories(
                    $factory,
                    $factory,
                    $factory,
                    $factory
                );
                return new GetTwitterUserApiClient(
                    $psrFactories->uriFactory()->createUri(config('client.api.twitter.base_url')),
                    new GuzzleClient(),
                    $psrFactories
                );
            });
            $this->app->singleton(GetTwitterUserByIdApiClientInterface::class, function() {
                $factory = new Psr17Factory();
                $psrFactories = new PsrFactories(
                    $factory,
                    $factory,
                    $factory,
                    $factory
                );
                return new GetTwitterUserByIdApiClient(
                    $psrFactories->uriFactory()->createUri(config('client.api.twitter.base_url')),
                    new GuzzleClient(),
                    $psrFactories
                );
            });
        }
    }
}
