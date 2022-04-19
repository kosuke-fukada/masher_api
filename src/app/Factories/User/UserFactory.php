<?php
declare(strict_types=1);

namespace App\Factories\User;

use App\Entities\User\UserInfo;
use App\Interfaces\Factories\User\UserFactoryInterface;
use App\ValueObjects\User\AccountId;
use App\ValueObjects\User\DisplayName;
use App\ValueObjects\User\Avatar;
use App\ValueObjects\User\AccessToken;
use App\ValueObjects\User\OauthProviderName;
use App\ValueObjects\User\RefreshToken;
use App\ValueObjects\User\UserId;

class UserFactory implements UserFactoryInterface
{
    /**
     * @param integer $userId
     * @param string $accountId
     * @param string $displayName
     * @param string $avatar
     * @param string $accessToken
     * @param string $refreshToken
     * @param string $provider
     * @return UserInfo
     */
    public function createUserEntity(
        int $userId,
        string $accountId,
        string $displayName,
        string $avatar,
        string $accessToken,
        string $refreshToken,
        string $provider
    ): UserInfo
    {
        return new UserInfo(
            new UserId($userId),
            new AccountId($accountId),
            new DisplayName($displayName),
            new Avatar($avatar),
            new AccessToken($accessToken),
            new RefreshToken($refreshToken),
            OauthProviderName::from($provider)
        );
    }
}
