<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\User\GetRedirectUrl;

use App\ValueObjects\User\OauthProviderName;

interface GetRedirectUrlInterface
{
    /**
     * @param OauthProviderName $oauthProviderName
     * @return string
     */
    public function process(OauthProviderName $oauthProviderName): string;
}
