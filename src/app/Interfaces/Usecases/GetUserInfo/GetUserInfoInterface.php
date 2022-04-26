<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\GetUserInfo;

use App\Entities\User\UserInfo;

interface GetUserInfoInterface
{
    /**
     * @return UserInfo|null
     */
    public function process(): ?UserInfo;
}
