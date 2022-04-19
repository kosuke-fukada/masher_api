<?php
declare(strict_types=1);

namespace Tests\Entities\User;

use App\Entities\User\UserInfo;
use App\ValueObjects\User\OauthProviderName;
use App\ValueObjects\User\AccessToken;
use App\ValueObjects\User\AccountId;
use App\ValueObjects\User\Avatar;
use App\ValueObjects\User\DisplayName;
use App\ValueObjects\User\RefreshToken;
use App\ValueObjects\User\UserId;
use Tests\TestCase;

class UserInfoTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $userId = 1;
        $accountId = 'test_account_id';
        $displayName = 'test-display-name';
        $avatar = 'https://example.com/test_image.png';
        $accessToken = 'test_access_token';
        $refreshToken = 'test_access_secret';
        $provider = 'twitter';

        $userEntity = new UserInfo(
            new UserId($userId),
            new AccountId($accountId),
            new DisplayName($displayName),
            new Avatar($avatar),
            new AccessToken($accessToken),
            new RefreshToken($refreshToken),
            OauthProviderName::from($provider)
        );

        $this->assertSame($userId, $userEntity->userId()->toInt());
        $this->assertSame($accountId, (string)$userEntity->accountId());
        $this->assertSame($displayName, (string)$userEntity->displayName());
        $this->assertSame($avatar, (string)$userEntity->avatar());
        $this->assertSame($accessToken, (string)$userEntity->accessToken());
        $this->assertSame($refreshToken, (string)$userEntity->refreshToken());
        $this->assertSame($provider, $userEntity->provider()->value);
        $this->assertIsArray($userEntity->toArrayWithoutCredentials());
        $this->assertSame($userId, $userEntity->toArrayWithoutCredentials()['user_id']);
        $this->assertSame($accountId, $userEntity->toArrayWithoutCredentials()['account_id']);
        $this->assertSame($displayName, $userEntity->toArrayWithoutCredentials()['display_name']);
        $this->assertSame($avatar, $userEntity->toArrayWithoutCredentials()['avatar']);
    }
}