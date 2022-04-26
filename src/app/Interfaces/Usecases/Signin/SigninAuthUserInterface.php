<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\Signin;

use App\ValueObjects\User\OauthProviderName;

interface SigninAuthUserInterface
{
    /**
     * @param OauthProviderName $oauthProviderName
     * @return void
     */
    public function process(OauthProviderName $oauthProviderName): void;
}
