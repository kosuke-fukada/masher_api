<?php
declare(strict_types=1);

namespace Tests\Repositories;

use App\Entities\User\User;
use Tests\TestCase;
use App\Repositories\UserRepository;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\ValueObjects\User\AccessToken;
use App\ValueObjects\User\AccountId;
use App\ValueObjects\User\Avatar;
use App\ValueObjects\User\DisplayName;
use App\ValueObjects\User\OauthProviderName;
use App\ValueObjects\User\RefreshToken;

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
    public function testProcess(UserRepositoryInterface $userRepository): void
    {
        $accountId = 'test_account_id';
        $displayName = 'test-display-name';
        $avatar = 'https://example.com/test_image.png';
        $accessToken = 'test_access_token';
        $refreshToken = 'test_refresh_token';
        $provider = 'twitter';
        $userEntity = new User(
            new AccountId($accountId),
            new DisplayName($displayName),
            new Avatar($avatar),
            new AccessToken($accessToken),
            new RefreshToken($refreshToken),
            OauthProviderName::from($provider)
        );
        $result = $userRepository->signin($userEntity);
        $this->assertInstanceOf(\App\Models\User::class, $result);
    }
}
