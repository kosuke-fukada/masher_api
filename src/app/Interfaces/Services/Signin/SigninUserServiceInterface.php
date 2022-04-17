<?php
declare(strict_types=1);

namespace App\Interfaces\Services\Signin;

use App\Entities\User\User;

interface SigninUserServiceInterface
{
    /**
     * @param User $user
     * @return \App\Models\UserInfo
     */
    public function process(User $user): \App\Models\UserInfo;
}
