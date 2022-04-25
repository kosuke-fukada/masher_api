<?php
declare(strict_types=1);

namespace Tests\Repositories\User;

use App\Entities\User\UserInfo;
use App\Interfaces\Repositories\User\UserRepositoryInterface;
use App\Models\User;
use App\Repositories\User\UserRepository;
use App\ValueObjects\User\AccessToken;
use App\ValueObjects\User\AccountId;
use App\ValueObjects\User\Avatar;
use App\ValueObjects\User\DisplayName;
use App\ValueObjects\User\OauthProviderName;
use App\ValueObjects\User\RefreshToken;
use App\ValueObjects\User\UserId;
use App\ValueObjects\User\UserName;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    /**
     * @return UserRepositoryInterface
     */
    public function test__construct(): UserRepositoryInterface
    {
        $userRepository = $this->app->make(UserRepositoryInterface::class);
        $this->assertInstanceOf(UserRepository::class, $userRepository);
        return $userRepository;
    }

    /**
     * @depends test__construct
     * @param UserRepositoryInterface $userRepository
     * @return void
     */
    public function testFindByAccountIdAndProvider(UserRepositoryInterface $userRepository): void
    {
        $accountId = 1;
        $provider = OauthProviderName::TWITTER;
        $result = $userRepository->findByAccountIdAndProvider(
            new AccountId($accountId),
            $provider
        );
        $this->assertInstanceOf(User::class, $result);

        $accountId = 1000;
        $result = $userRepository->findByAccountIdAndProvider(
            new AccountId($accountId),
            $provider
        );
        $this->assertNull($result);
    }

    /**
     * @depends test__construct
     * @param UserRepositoryInterface $userRepository
     * @return void
     */
    public function testUpdateUser(UserRepositoryInterface $userRepository): void
    {
        $userId = 1;
        $accountId = 1;
        $userName = 'test_user_name_updated';
        $displayName = 'test_display_name_updated';
        $avatar = 'https://example.local/test_avatar_updated.png';
        $accessToken = 'test_access_token_updated';
        $refreshToken = 'test_refresh_token_updated';
        $userInfo = new UserInfo(
            new UserId($userId),
            new AccountId($accountId),
            new UserName($userName),
            new DisplayName($displayName),
            new Avatar($avatar),
            new AccessToken($accessToken),
            new RefreshToken($refreshToken),
            OauthProviderName::TWITTER
        );
        $userRepository->updateUser($userInfo);
        $user = (new User())->newQuery()->find($userId);
        $this->assertSame($userName, $user->getAttribute('user_name'));
        $this->assertSame($displayName, $user->getAttribute('display_name'));
        $this->assertSame($avatar, $user->getAttribute('avatar'));
        $this->assertSame($accessToken, $user->getAttribute('access_token'));
        $this->assertSame($refreshToken, $user->getAttribute('refresh_token'));
    }
}
