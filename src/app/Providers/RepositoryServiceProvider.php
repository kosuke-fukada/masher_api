<?php
declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\Repositories\UserInfoRepositoryInterface;
use App\Repositories\UserInfoRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserInfoRepositoryInterface::class, UserInfoRepository::class);
    }
}
