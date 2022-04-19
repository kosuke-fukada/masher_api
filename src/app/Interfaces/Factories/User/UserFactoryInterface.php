<?php
declare(strict_types=1);

namespace App\Interfaces\Factories\User;

use App\Entities\User\UserInfo;

interface UserFactoryInterface
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
        string $provider,
    ): UserInfo;
}
