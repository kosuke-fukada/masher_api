<?php
declare(strict_types=1);

namespace Tests\Services\Signin;

use Tests\TestCase;
use App\Models\UserInfo;
use App\Entities\User\User;
use App\ValueObjects\User\Avatar;
use App\ValueObjects\User\AccountId;
use App\ValueObjects\User\AccessToken;
use App\ValueObjects\User\DisplayName;
use App\ValueObjects\User\RefreshToken;
use App\Services\Signin\SigninUserService;
use App\ValueObjects\User\OauthProviderName;
use App\Interfaces\Services\Signin\SigninUserServiceInterface;
use App\ValueObjects\User\UserId;

class SigninUserServiceTest extends TestCase
{
    /**
     * @return SigninUserServiceInterface
     */
    public function test__construct(): SigninUserServiceInterface
    {
        $signinUserService = $this->app->make(SigninUserServiceInterface::class);
        $this->assertInstanceOf(SigninUserService::class, $signinUserService);
        return $signinUserService;
    }

    /**
     * @depends test__construct
     * @param SigninUserServiceInterface $signinUserService
     * @return void
     */
    public function testProcess(SigninUserServiceInterface $signinUserService): void
    {
        $userId = 1;
        $accountId = 'test_account_id';
        $displayName = 'test-display-name';
        $avatar = 'https://example.com/test_image.png';
        $accessToken = 'test_access_token';
        $refreshToken = 'test_refresh_token';
        $provider = 'twitter';
        $userEntity = new User(
            new UserId($userId),
            new AccountId($accountId),
            new DisplayName($displayName),
            new Avatar($avatar),
            new AccessToken($accessToken),
            new RefreshToken($refreshToken),
            OauthProviderName::from($provider)
        );
        $signinUserService->process($userEntity);
        $userInfoModel = new UserInfo();
        $userInfo = $userInfoModel->newQuery()->find(1);
        $this->assertNotEmpty($userInfo);
        $this->assertSame($userId, $userInfo->getAttribute('user_id'));
        $this->assertSame($accountId, $userInfo->getAttribute('account_id'));
        $this->assertSame($displayName, $userInfo->getAttribute('display_name'));
        $this->assertSame($avatar, $userInfo->getAttribute('avatar'));
        $this->assertSame($accessToken, $userInfo->getAttribute('access_token'));
        $this->assertSame($refreshToken, $userInfo->getAttribute('refresh_token'));
        $this->assertSame($provider, $userInfo->getAttribute('provider'));
    }
}
