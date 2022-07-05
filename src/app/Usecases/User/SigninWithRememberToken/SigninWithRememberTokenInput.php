<?php
declare(strict_types=1);

namespace App\Usecases\User\SigninWithRememberToken;

use App\Interfaces\Usecases\User\SigninWithRememberToken\SigninWithRememberTokenInputPort;
use App\ValueObjects\User\RememberToken;

class SigninWithRememberTokenInput implements SigninWithRememberTokenInputPort
{
    /**
     * @var RememberToken
     */
    private RememberToken $rememberToken;

    /**
     * @param RememberToken $rememberToken
     */
    public function __construct(RememberToken $rememberToken)
    {
        $this->rememberToken = $rememberToken;
    }

    /**
     * @return RememberToken
     */
    public function rememberToken(): RememberToken
    {
        return $this->rememberToken;
    }
}
