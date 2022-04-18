<?php
declare(strict_types=1);

namespace App\Interfaces\Repositories;

use App\Models\UserInfo;
use App\Entities\User\User;

interface UserInfoRepositoryInterface
{
    /**
     * @param User $user
     * @return UserInfo
     */
    public function signin(User $user): UserInfo;
}
