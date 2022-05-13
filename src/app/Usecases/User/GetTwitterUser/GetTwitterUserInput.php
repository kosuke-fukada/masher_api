<?php
declare(strict_types=1);

namespace App\Usecases\User\GetTwitterUser;

use App\Interfaces\Usecases\User\GetTwitterUser\GetTwitterUserInputPort;
use App\ValueObjects\Shared\UserName;

class GetTwitterUserInput implements GetTwitterUserInputPort
{
    /**
     * @var UserName
     */
    private UserName $userName;

    /**
     * @param UserName $userName
     */
    public function __construct(UserName $userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return UserName
     */
    public function userName(): UserName
    {
        return $this->userName;
    }
}
