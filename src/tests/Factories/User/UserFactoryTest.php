<?php
declare(strict_types=1);

namespace Tests\Factories\User;

use App\Entities\User\UserInfo;
use Tests\TestCase;
use App\Factories\User\UserFactory;
use App\Interfaces\Factories\User\UserFactoryInterface;

class UserFactoryTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $userFactory = $this->app->make(UserFactoryInterface::class);
        $this->assertInstanceOf(UserFactory::class, $userFactory);

        $userId = 1;
        $accountId = 1;
        $userName = 'test_user_name';
        $displayName = 'test-display-name';
        $avatar = 'https://example.com/test_image.png';
        $accessToken = 'test_access_token';
        $refreshToken = 'test_refresh_token';
        $provider = 'twitter';

        $userEntity = $userFactory->createUserEntity(
            $userId,
            $accountId,
            $userName,
            $displayName,
            $avatar,
            $accessToken,
            $refreshToken,
            $provider,
        );

        $this->assertInstanceOf(UserInfo::class, $userEntity);
    }
}
