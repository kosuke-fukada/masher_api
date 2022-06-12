<?php
declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\Repositories\Inquiry\InquiryRepositoryInterface;
use App\Interfaces\Repositories\Like\LikeRepositoryInterface;
use App\Interfaces\Repositories\User\UserRepositoryInterface;
use App\Repositories\Inquiry\InquiryRepository;
use App\Repositories\Like\LikeRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(LikeRepositoryInterface::class, LikeRepository::class);
        $this->app->singleton(InquiryRepositoryInterface::class, InquiryRepository::class);
    }
}
