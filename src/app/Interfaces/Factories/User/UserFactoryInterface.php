<?php
declare(strict_types=1);

namespace App\Interfaces\Factories\User;

use App\Entities\User\UserInfo;

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
     * @param integer|null $expiresAt
     * @param string $provider
     * @return UserInfo
     */
    public function createUserEntity(
        int $userId,
        string $accountId,
        string $userName,
        string $displayName,
        string $avatar,
        string $accessToken,
        ?string $refreshToken,
        ?int $expiresAt,
        string $provider,
    ): UserInfo;
}
