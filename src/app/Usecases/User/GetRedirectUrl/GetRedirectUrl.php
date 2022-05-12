<?php
declare(strict_types=1);

namespace App\Usecases\User\GetRedirectUrl;

use App\Interfaces\Usecases\User\GetRedirectUrl\GetRedirectUrlInterface;
use App\ValueObjects\User\OauthProviderName;
use Laravel\Socialite\Facades\Socialite;

class GetRedirectUrl implements GetRedirectUrlInterface
{
   /**
    * @param OauthProviderName $oauthProviderName
    * @return string
    */
    public function process(OauthProviderName $oauthProviderName): string
    {
        return Socialite::driver($oauthProviderName->value)->scopes(['offline.access', 'like.read'])->redirect()->getTargetUrl();
    }
}
