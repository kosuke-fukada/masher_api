<?php
declare(strict_types=1);

namespace App\Interfaces\Services\Signin;

use App\Models\UserInfo;
use App\Entities\User\User;

interface SigninUserServiceInterface
{
    /**
     * @param User $user
     * @return UserInfo
     */
    public function process(User $user): UserInfo;
}
