<?php
declare(strict_types=1);

namespace App\Interfaces\Factories\User;

interface UserFactoryInterface
{
    public function createUserEntity(
        string $accountId,
        string $displayName,
        string $avatar,
        string $accessToken,
        string $refreshToken,
        string $provider,
    );
}
