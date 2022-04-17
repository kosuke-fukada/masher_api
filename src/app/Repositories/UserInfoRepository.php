<?php
declare(strict_types=1);

namespace App\Repositories;

use Throwable;
use RuntimeException;
use App\Models\UserInfo;
use App\Entities\User\User;
use Illuminate\Support\Facades\DB;
use App\Exceptions\ExceptionBaseClass;
use App\Interfaces\Repositories\UserInfoRepositoryInterface;

class UserInfoRepository implements UserInfoRepositoryInterface
{
    /**
     * @var UserInfo
     */
    private UserInfo $userInfo;

    /**
     * @param UserInfo $userInfo
     */
    public function __construct(UserInfo $userInfo)
    {
        $this->userInfo = $userInfo;
    }

    /**
     * @param User $user
     * @return UserInfo
     */
    public function signin(User $user): UserInfo
    {
        $userInfo = $this->userInfo->newQuery()
            ->firstOrNew([
                'account_id' => (string)$user->accountId(),
                'provider' => $user->provider()->value,
            ]);
        if (!$userInfo->exists) {
            $userInfo->fill([
                'display_name' => (string)$user->displayName(),
                'avatar' => (string)$user->avatar(),
                'access_token' => (string)$user->accessToken(),
                'refresh_token' => (string)$user->refreshToken(),
            ]);
            DB::beginTransaction();
            if (!$userInfo->save()) {
                DB::rollBack();
                throw new RuntimeException('Failed to create a user.', ExceptionBaseClass::STATUS_CODE_INTERNAL_SERVER_ERROR);
            }
            DB::commit();
        } else {
            DB::beginTransaction();
            try {
                $userInfo->update([
                    'account_id' => (string)$user->accountId(),
                    'display_name' => (string)$user->displayName(),
                    'avatar' => (string)$user->avatar(),
                ]);
            } catch (Throwable $e) {
                throw new RuntimeException($e->getMessage(), $e->getCode());
            }
        }

        return $userInfo;
    }
}
