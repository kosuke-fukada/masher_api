<?php
declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\Services\Inquiry\PostInquiry\SendInquiryMailServiceInterface;
use App\Interfaces\Services\User\Signin\SetAuthSessionServiceInterface;
use App\Services\Inquiry\PostInquiry\SendInquiryMailMockService;
use App\Services\Inquiry\PostInquiry\SendInquiryMailService;
use App\Services\User\Signin\SetAuthSessionService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SetAuthSessionServiceInterface::class, SetAuthSessionService::class);
        if (App::environment(['testing'])) {
            $this->app->singleton(SendInquiryMailServiceInterface::class, SendInquiryMailMockService::class);
        } else {
            $this->app->singleton(SendInquiryMailServiceInterface::class, SendInquiryMailService::class);
        }
    }
}
