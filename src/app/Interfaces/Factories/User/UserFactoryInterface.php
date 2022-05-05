<?php
declare(strict_types=1);

namespace App\Interfaces\Factories\User;

use App\Entities\User\UserInfo;
use App\Models\User;

interface UserFactoryInterface
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
        string $provider,
    ): UserInfo;

    /**
     * @param User $user
     * @return UserInfo
     */
    public function createUserInfoFromUserModel(User $user): UserInfo;
}
