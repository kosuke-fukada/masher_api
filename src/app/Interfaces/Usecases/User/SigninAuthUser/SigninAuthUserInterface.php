<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\User\SigninAuthUser;

use App\Models\User;
use App\ValueObjects\User\OauthProviderName;

interface SigninAuthUserInterface
{
    /**
     * @param OauthProviderName $oauthProviderName
     * @return User
     */
    public function process(OauthProviderName $oauthProviderName): User;
}
