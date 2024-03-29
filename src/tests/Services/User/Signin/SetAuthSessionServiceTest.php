<?php
declare(strict_types=1);

namespace Tests\Services\User\Signin;

use Tests\TestCase;
use App\Models\User;
use App\ValueObjects\User\AccountId;
use Illuminate\Support\Facades\Auth;
use App\ValueObjects\User\OauthProviderName;
use App\Services\User\Signin\SetAuthSessionService;
use App\Interfaces\Repositories\User\UserRepositoryInterface;
use App\Interfaces\Services\User\Signin\SetAuthSessionServiceInterface;

class SetAuthSessionServiceTest extends TestCase
{
    /**
     * @return SetAuthSessionServiceInterface
     */
    public function test__construct(): SetAuthSessionServiceInterface
    {
        $setAuthSessionService = $this->app->make(SetAuthSessionServiceInterface::class);
        $this->assertInstanceOf(SetAuthSessionService::class, $setAuthSessionService);
        return $setAuthSessionService;
    }

    /**
     * @depends test__construct
     * @param SetAuthSessionServiceInterface $setAuthSessionService
     * @return void
     */
    public function testProcess(SetAuthSessionServiceInterface $setAuthSessionService): void
    {
        $accountId = 'test_account_id';
        $userRepository = $this->app->make(UserRepositoryInterface::class);
        $user = $userRepository->findByAccountIdAndProvider(
            new AccountId($accountId),
            OauthProviderName::TWITTER
        );
        $providerAuthenticatedUser = $setAuthSessionService->process($user);
        $this->assertTrue(Auth::check());
        $this->assertSame(1, $providerAuthenticatedUser->getAttribute('id'));

        $user = new User([
            'account_id' => 'test_account_id_2',
            'user_name' => 'test_user_name_2',
            'display_name' => 'test_display_name_2',
            'avatar' => 'https://example.com/test_image_2.png',
            'access_token' => 'test_access_token_2',
            'refresh_token' => 'test_refresh_token_2',
            'expires_at' => date('Y-m-d H:i:s'),
            'provider' => 'twitter'
        ]);
        $providerAuthenticatedUser = $setAuthSessionService->process($user);
        $this->assertTrue(Auth::check());
        $this->assertSame(2, $providerAuthenticatedUser->getAttribute('id'));
    }
}
