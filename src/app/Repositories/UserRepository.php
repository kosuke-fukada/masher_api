<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Exceptions\ExceptionBaseClass;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\UserInfo;
use Illuminate\Support\Facades\DB;
use RuntimeException;
use Throwable;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var UserInfo
     */
    private UserInfo $model;

    /**
     * @param UserInfo $model
     */
    public function __construct(UserInfo $model)
    {
        $this->model = $model;
    }

    /**
     * @param \App\Entities\User\User $user
     * @return UserInfo
     */
    public function signin(\App\Entities\User\User $user): UserInfo
    {
        $authUser = $this->model->newQuery()
            ->firstOrNew([
                'account_id' => (string)$user->accountId(),
                'provider' => $user->provider()->value,
            ]);
        if (!$authUser->exists) {
            $authUser->fill([
                'display_name' => (string)$user->displayName(),
                'avatar' => (string)$user->avatar(),
                'access_token' => (string)$user->accessToken(),
                'refresh_token' => (string)$user->refreshToken(),
            ]);
            DB::beginTransaction();
            if (!$authUser->save()) {
                DB::rollBack();
                throw new RuntimeException('Failed to create a user.', ExceptionBaseClass::STATUS_CODE_INTERNAL_SERVER_ERROR);
            }
            DB::commit();
        } else {
            DB::beginTransaction();
            try {
                $authUser->update([
                    'account_id' => (string)$user->accountId(),
                    'display_name' => (string)$user->displayName(),
                    'avatar' => (string)$user->avatar(),
                ]);
            } catch (Throwable $e) {
                throw new RuntimeException($e->getMessage(), $e->getCode());
            }
        }

        return $authUser;
    }
}
