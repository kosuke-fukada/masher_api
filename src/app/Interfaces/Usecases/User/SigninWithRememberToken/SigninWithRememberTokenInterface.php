<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\User\SigninWithRememberToken;

use App\Entities\User\UserInfo;

interface SigninWithRememberTokenInterface
{
    /**
     * @return UserInfo|null
     */
    public function process(SigninWithRememberTokenInputPort $input): ?UserInfo;
}
