<?php
declare(strict_types=1);

namespace Tests\Entities\User;

use App\Entities\User\User;
use App\ValueObjects\User\OauthProviderName;
use App\ValueObjects\User\AccessToken;
use App\ValueObjects\User\AccountId;
use App\ValueObjects\User\Avatar;
use App\ValueObjects\User\DisplayName;
use App\ValueObjects\User\RefreshToken;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @return void
     */
    public function test__construct(): void
    {
        $accountId = 'test_account_id';
        $displayName = 'test-display-name';
        $avatar = 'https://example.com/test_image.png';
        $accessToken = 'test_access_token';
        $refreshToken = 'test_access_secret';
        $provider = 'twitter';

        $userEntity = new User(
            new AccountId($accountId),
            new DisplayName($displayName),
            new Avatar($avatar),
            new AccessToken($accessToken),
            new RefreshToken($refreshToken),
            OauthProviderName::from($provider)
        );

        $this->assertSame($accountId, (string)$userEntity->accountId());
        $this->assertSame($displayName, (string)$userEntity->displayName());
        $this->assertSame($avatar, (string)$userEntity->avatar());
        $this->assertSame($accessToken, (string)$userEntity->accessToken());
        $this->assertSame($refreshToken, (string)$userEntity->refreshToken());
        $this->assertSame($provider, $userEntity->provider()->value);
    }
}
