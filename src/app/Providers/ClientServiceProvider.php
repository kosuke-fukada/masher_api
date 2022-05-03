<?php
declare(strict_types=1);

namespace App\Providers;

use App\Clients\GetTwitterLikeList\GetTwitterLikeListApiClient;
use App\Client\GuzzleClient;
use App\Client\PsrFactories;
use App\Interfaces\Clients\GetTwitterLikeList\GetTwitterLikeListApiClientInterface;
use Illuminate\Support\Facades\App;
use Nyholm\Psr7\Factory\Psr17Factory;
use Illuminate\Support\ServiceProvider;
use Tests\Mock\Clients\GetTwitterLikeList\GetTwitterLikeListApiClientMock;

class ClientServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        if (App::environment('testing')) {
            $this->app->singleton(GetTwitterLikeListApiClientInterface::class, GetTwitterLikeListApiClientMock::class);
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
                    $psrFactories->uriFactory()->createUri(config('api.twitter.base_url')),
                    new GuzzleClient(),
                    $psrFactories
                );
            });
        }
    }
}
