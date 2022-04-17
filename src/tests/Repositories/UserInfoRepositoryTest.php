<?php
declare(strict_types=1);

namespace Tests\Repositories;

use Tests\TestCase;
use App\Models\UserInfo;
use App\Entities\User\User;
use App\ValueObjects\User\Avatar;
use App\Repositories\UserInfoRepository;
use App\ValueObjects\User\AccountId;
use App\ValueObjects\User\AccessToken;
use App\ValueObjects\User\DisplayName;
use App\ValueObjects\User\RefreshToken;
use App\ValueObjects\User\OauthProviderName;
use App\Interfaces\Repositories\UserInfoRepositoryInterface;
use App\ValueObjects\User\UserId;

class UserInfoRepositoryTest extends TestCase
{
    /**
     * @return UserInfoRepositoryInterface
     */
    public function test__construct(): UserInfoRepositoryInterface
    {
        $userInfoRepository = $this->app->make(UserInfoRepositoryInterface::class);
        $this->assertInstanceOf(UserInfoRepository::class, $userInfoRepository);
        return $userInfoRepository;
    }

    /**
     * @depends test__construct
     * @param UserInfoRepositoryInterface $userInfoRepository
     * @return void
     */
    public function testProcess(UserInfoRepositoryInterface $userInfoRepository): void
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
        $result = $userInfoRepository->signin($userEntity);
        $this->assertInstanceOf(UserInfo::class, $result);
    }
}
