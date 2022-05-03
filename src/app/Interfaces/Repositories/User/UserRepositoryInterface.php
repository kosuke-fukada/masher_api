<?php
declare(strict_types=1);

namespace App\Interfaces\Repositories\User;

use App\Models\User;
use App\ValueObjects\User\OauthProviderName;
use App\ValueObjects\User\AccountId;

interface UserRepositoryInterface
{
    /**
     * @param AccountId $accountId
     * @param OauthProviderName $provider
     * @return User|null
     */
    public function findByAccountIdAndProvider(AccountId $accountId, OauthProviderName $provider): ?User;

    /**
     * @param \App\Entities\User\UserInfo $userInfo
     * @return void
     */
    public function updateUser(\App\Entities\User\UserInfo $userInfo): void;

    /**
     * @return User|null
     */
    public function findAuthUser(): ?User;
}
