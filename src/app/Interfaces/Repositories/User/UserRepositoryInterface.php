<?php
declare(strict_types=1);

namespace App\Interfaces\Repositories\User;

use App\Models\User;
use App\ValueObjects\User\UserId;
use App\ValueObjects\User\AccountId;
use App\ValueObjects\User\OauthProviderName;

interface UserRepositoryInterface
{
    /**
     * @param UserId $id
     * @return User|null
     */
    public function findById(UserId $id): ?User;

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
