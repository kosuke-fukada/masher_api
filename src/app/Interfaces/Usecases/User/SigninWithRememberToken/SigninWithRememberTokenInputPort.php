<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\User\SigninWithRememberToken;

use App\ValueObjects\User\RememberToken;

interface SigninWithRememberTokenInputPort
{
    /**
     * @return RememberToken
     */
    public function rememberToken(): RememberToken;
}
