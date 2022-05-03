<?php
declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;
use App\Entities\User\UserInfo;
use App\ValueObjects\User\AccountId;
use Illuminate\Support\Facades\Auth;
use App\ValueObjects\User\OauthProviderName;
use App\Interfaces\Repositories\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    private User $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param AccountId $accountId
     * @param OauthProviderName $provider
     * @return User|null
     */
    public function findByAccountIdAndProvider(AccountId $accountId, OauthProviderName $provider): ?User
    {
        return $this->user->newQuery()
            ->where('account_id', '=', (string)$accountId)
            ->where('provider', '=', $provider->value)
            ->first();
    }

    /**
     * @param UserInfo $userInfo
     * @return void
     */
    public function updateUser(UserInfo $userInfo): void
    {
        $targetUser = $this->user->newQuery()->find($userInfo->userId()->toInt());
        $targetUser->fill([
            'user_name' => (string)$userInfo->userName(),
            'display_name' => (string)$userInfo->displayName(),
            'avatar' => (string)$userInfo->avatar(),
            'access_token' => (string)$userInfo->accessToken(),
            'refresh_token' => (string)$userInfo->refreshToken(),
        ]);
        $targetUser->save();
    }

    /**
     * @return User|null
     */
    public function findAuthUser(): ?User
    {
        return Auth::user();
    }
}
