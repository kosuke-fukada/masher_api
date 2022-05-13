<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\User\GetTwitterUser;

use App\ValueObjects\Shared\UserName;

interface GetTwitterUserInputPort
{
    /**
     * @return UserName
     */
    public function userName(): UserName;
}
