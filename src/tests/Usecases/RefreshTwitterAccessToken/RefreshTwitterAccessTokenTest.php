<?php
declare(strict_types=1);

namespace Tests\Usecases\RefreshTwitterAccessToken;

use Tests\TestCase;
use App\ValueObjects\User\AccountId;
use Illuminate\Support\Facades\Auth;
use App\ValueObjects\User\OauthProviderName;
use App\Interfaces\Repositories\User\UserRepositoryInterface;
use App\Usecases\RefreshTwitterAccessToken\RefreshTwitterAccessToken;
use App\Interfaces\Usecases\RefreshTwitterAccessToken\RefreshTwitterAccessTokenInterface;
use App\ValueObjects\User\UserId;

class RefreshTwitterAccessTokenTest extends TestCase
{
    /**
     * @return RefreshTwitterAccessTokenInterface
     */
    public function test__construct(): RefreshTwitterAccessTokenInterface
    {
        $usecase = $this->app->make(RefreshTwitterAccessTokenInterface::class);
        $this->assertInstanceOf(RefreshTwitterAccessToken::class, $usecase);
        return $usecase;
    }

    /**
     * @depends test__construct
     * @param RefreshTwitterAccessTokenInterface $usecase
     * @return void
     */
    public function testProcess(RefreshTwitterAccessTokenInterface $usecase): void
    {
        $accountId = 'test_account_id';
        $userRepository = $this->app->make(UserRepositoryInterface::class);
        $user = $userRepository->findByAccountIdAndProvider(
            new AccountId($accountId),
            OauthProviderName::TWITTER
        );
        Auth::login($user);
        $usecase->process();
        $authUser = $userRepository->findAuthUser();
        $this->assertNotSame($user->getAttribute('access_token'), $authUser->getAttribute('access_token'));
        $this->assertNotSame($user->getAttribute('refresh_token'), $authUser->getAttribute('refresh_token'));
        $this->assertNotSame($user->getAttribute('expires_at'), $authUser->getAttribute('expires_at'));
        $refreshedUser = $userRepository->findById(new UserId($user->getAttribute('id')));
        $this->assertSame($authUser->getAttribute('access_token'), $refreshedUser->getAttribute('access_token'));
        $this->assertSame($authUser->getAttribute('refresh_token'), $refreshedUser->getAttribute('refresh_token'));
        $this->assertSame($authUser->getAttribute('expires_at'), $refreshedUser->getAttribute('expires_at'));
    }
}
