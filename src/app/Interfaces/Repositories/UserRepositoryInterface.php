<?php
declare(strict_types=1);

namespace App\Interfaces\Repositories;

use App\Models\UserInfo;

interface UserRepositoryInterface
{
    /**
     * @return UserInfo
     */
    public function signin(\App\Entities\User\User $user): UserInfo;
}
