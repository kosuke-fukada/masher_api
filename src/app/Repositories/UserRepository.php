<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Exceptions\ExceptionBaseClass;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;
use RuntimeException;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    private User $model;

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param \App\Entities\User\User $user
     * @return User
     */
    public function signin(\App\Entities\User\User $user): User
    {
        $authUser = $this->model->newQuery()
            ->firstOrNew(['account_id' => (string)$user->accountId()]);
        if (!$authUser->exists) {
            $authUser->fill([
                'display_name' => (string)$user->displayName(),
                'avatar' => (string)$user->avatar(),
                'access_token' => (string)$user->accessToken(),
                'refresh_token' => (string)$user->refreshToken(),
                'provider' => $user->provider()->value,
            ]);
            if (!$authUser->save()) {
                throw new RuntimeException('Failed to create a user.', ExceptionBaseClass::STATUS_CODE_INTERNAL_SERVER_ERROR);
            }
        }

        return $authUser;
    }
}
