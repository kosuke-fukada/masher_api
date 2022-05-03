<?php
declare(strict_types=1);

namespace Tests\Repositories\User;

use Tests\TestCase;
use App\Models\User;
use App\Entities\User\UserInfo;
use App\ValueObjects\User\Avatar;
use App\ValueObjects\User\UserId;
use App\ValueObjects\User\UserName;
use App\ValueObjects\User\AccountId;
use Illuminate\Support\Facades\Auth;
use App\ValueObjects\User\AccessToken;
use App\ValueObjects\User\DisplayName;
use App\ValueObjects\User\RefreshToken;
use App\Repositories\User\UserRepository;
use App\ValueObjects\User\OauthProviderName;
use App\Interfaces\Repositories\User\UserRepositoryInterface;

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
        $accountId = 'test_account_id';
        $provider = OauthProviderName::TWITTER;
        $result = $userRepository->findByAccountIdAndProvider(
            new AccountId($accountId),
            $provider
        );
        $this->assertInstanceOf(User::class, $result);

        $accountId = 'test_invalid_account_id';
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
        $accountId = 'test_account_id';
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

    /**
     * @depends test__construct
     * @param UserRepositoryInterface $userRepository
     * @return void
     */
    public function testFindAuthUser(UserRepositoryInterface $userRepository): void
    {
        $authUser = $userRepository->findAuthUser();
        $this->assertNull($authUser);

        $accountId = 'test_account_id';
        $user = $userRepository->findByAccountIdAndProvider(
            new AccountId($accountId),
            OauthProviderName::TWITTER
        );
        Auth::login($user);
        $authUser = $userRepository->findAuthUser();
        $this->assertSame($user->getAttribute('id'), $authUser->getAttribute('id'));
    }
}
