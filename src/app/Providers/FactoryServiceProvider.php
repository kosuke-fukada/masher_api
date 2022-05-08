<?php
declare(strict_types=1);

namespace App\Providers;

use App\Factories\Tweet\TweetFactory;
use App\Factories\User\UserFactory;
use App\Interfaces\Factories\Tweet\TweetFactoryInterface;
use App\Interfaces\Factories\User\UserFactoryInterface;
use Illuminate\Support\ServiceProvider;

class FactoryServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserFactoryInterface::class, UserFactory::class);
        $this->app->singleton(TweetFactoryInterface::class, TweetFactory::class);
    }
}
