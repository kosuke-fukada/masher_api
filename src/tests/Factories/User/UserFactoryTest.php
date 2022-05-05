<?php
declare(strict_types=1);

namespace Tests\Factories\User;

use Tests\TestCase;
use App\Models\User;
use App\Entities\User\UserInfo;
use App\Factories\User\UserFactory;
use App\Interfaces\Factories\User\UserFactoryInterface;

class UserFactoryTest extends TestCase
{
    /**
     * @return UserFactoryInterface
     */
    public function test__construct(): UserFactoryInterface
    {
        $userFactory = $this->app->make(UserFactoryInterface::class);
        $this->assertInstanceOf(UserFactory::class, $userFactory);
        return $userFactory;
    }

    /**
     * @depends test__construct
     * @param UserFactoryInterface $userFactory
     * @return void
     */
    public function testCreateUserInfo(UserFactoryInterface $userFactory): void
    {
        $userId = 1;
        $accountId = 'test_account_id';
        $userName = 'test_user_name';
        $displayName = 'test-display-name';
        $avatar = 'https://example.com/test_image.png';
        $accessToken = 'test_access_token';
        $refreshToken = 'test_refresh_token';
        $expiresAt = time();
        $provider = 'twitter';

        $userInfo = $userFactory->createUserInfo(
            $userId,
            $accountId,
            $userName,
            $displayName,
            $avatar,
            $accessToken,
            $refreshToken,
            $expiresAt,
            $provider,
        );

        $this->assertInstanceOf(UserInfo::class, $userInfo);
        $this->assertSame($userId, $userInfo->userId()->toInt());
        $this->assertSame($accountId, (string)$userInfo->accountId());
        $this->assertSame($userName, (string)$userInfo->userName());
        $this->assertSame($displayName, (string)$userInfo->displayName());
        $this->assertSame($avatar, (string)$userInfo->avatar());
        $this->assertSame($accessToken, (string)$userInfo->accessToken());
        $this->assertSame($refreshToken, (string)$userInfo->refreshToken());
        $this->assertSame($expiresAt, $userInfo->expiresAt()->toTimestamp());
        $this->assertSame($provider, $userInfo->provider()->value);
    }

    /**
     * @depends test__construct
     * @param UserFactoryInterface $userFactory
     * @return void
     */
    public function testCreateUserInfoFromUserModel(UserFactoryInterface $userFactory): void
    {
        $userId = 1;
        $accountId = 'test_account_id';
        $userName = 'test_user_name';
        $displayName = 'test-display-name';
        $avatar = 'https://example.com/test_image.png';
        $accessToken = 'test_access_token';
        $refreshToken = 'test_refresh_token';
        $expiresAt = date('Y-m-d H:i:s');
        $provider = 'twitter';
        $user = new User([
            'id' => $userId,
            'account_id' => $accountId,
            'user_name' => $userName,
            'display_name' => $displayName,
            'avatar' => $avatar,
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
            'expires_at' => $expiresAt,
            'provider' => $provider
        ]);
        $userInfo = $userFactory->createUserInfoFromUserModel($user);
        $this->assertInstanceOf(UserInfo::class, $userInfo);
        $this->assertSame($userId, $userInfo->userId()->toInt());
        $this->assertSame($accountId, (string)$userInfo->accountId());
        $this->assertSame($userName, (string)$userInfo->userName());
        $this->assertSame($displayName, (string)$userInfo->displayName());
        $this->assertSame($avatar, (string)$userInfo->avatar());
        $this->assertSame($accessToken, (string)$userInfo->accessToken());
        $this->assertSame($refreshToken, (string)$userInfo->refreshToken());
        $this->assertSame($expiresAt, $userInfo->expiresAt()->toDate());
        $this->assertSame($provider, $userInfo->provider()->value);
    }
}
