<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\Signin;

use App\Models\UserInfo;
use App\ValueObjects\User\OauthProviderName;

interface SigninAuthUserInterface
{
    /**
     * @param OauthProviderName $oauthProviderName
     * @return UserInfo
     */
    public function process(OauthProviderName $oauthProviderName): UserInfo;
}
