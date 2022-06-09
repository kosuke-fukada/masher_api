<?php
declare(strict_types=1);

namespace App\Factories\User;

use App\Models\User;
use Carbon\CarbonImmutable;
use App\Entities\User\UserInfo;
use App\ValueObjects\User\Avatar;
use App\ValueObjects\User\UserId;
use App\ValueObjects\User\AccountId;
use App\ValueObjects\User\ExpiresAt;
use App\ValueObjects\Shared\UserName;
use App\ValueObjects\User\AccessToken;
use App\ValueObjects\User\DisplayName;
use App\ValueObjects\User\RefreshToken;
use App\ValueObjects\User\OauthProviderName;
use App\Interfaces\Factories\User\UserFactoryInterface;

class UserFactory implements UserFactoryInterface
{
    /**
     * @param integer $userId
     * @param string $accountId
     * @param string $userName
     * @param string $displayName
     * @param string $avatar
     * @param string $accessToken
     * @param string|null $refreshToken
     * @param string|null $expiresAt
     * @param string $provider
     * @return UserInfo
     */
    public function createUserInfo(
        int $userId,
        string $accountId,
        string $userName,
        string $displayName,
        string $avatar,
        string $accessToken,
        ?string $refreshToken,
        ?string $expiresAt,
        string $provider
    ): UserInfo
    {
        return new UserInfo(
            new UserId($userId),
            new AccountId($accountId),
            new UserName($userName),
            new DisplayName($displayName),
            new Avatar($avatar),
            new AccessToken($accessToken),
            new RefreshToken($refreshToken),
            new ExpiresAt(new CarbonImmutable($expiresAt)),
            OauthProviderName::from($provider)
        );
    }

    /**
     * @param User $user
     * @return UserInfo
     */
    public function createUserInfoFromUserModel(User $user): UserInfo
    {
        return $this->createUserInfo(
            $user->getAttribute('id'),
            $user->getAttribute('account_id'),
            $user->getAttribute('user_name'),
            $user->getAttribute('display_name'),
            $user->getAttribute('avatar'),
            $user->getAttribute('access_token'),
            $user->getAttribute('refresh_token'),
            $user->getAttribute('expires_at'),
            $user->getAttribute('provider'),
        );
    }
}
