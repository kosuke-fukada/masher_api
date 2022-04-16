<?php
declare(strict_types=1);

namespace App\Entities\User;

use App\ValueObjects\User\Avatar;
use App\ValueObjects\User\AccountId;
use App\ValueObjects\User\AccessToken;
use App\ValueObjects\User\DisplayName;
use App\ValueObjects\User\RefreshToken;
use App\ValueObjects\User\OauthProviderName;

class User
{
    /**
     * @var AccountId
     */
    private AccountId $accountId;

    /**
     * @var DisplayName
     */
    private DisplayName $displayName;

    /**
     * @var Avatar
     */
    private Avatar $avatar;

    /**
     * @var AccessToken
     */
    private AccessToken $accessToken;

    /**
     * @var RefreshToken
     */
    private RefreshToken $refreshToken;

    /**
     * @var OauthProviderName
     */
    private OauthProviderName $provider;

    /**
     * @param AccountId $accountId
     * @param DisplayName $displayName
     * @param Avatar $avatar
     * @param AccessToken $accessToken
     * @param RefreshToken $refreshToken
     * @param OauthProviderName $provider
     */
    public function __construct(
        AccountId $accountId,
        DisplayName $displayName,
        Avatar $avatar,
        AccessToken $accessToken,
        RefreshToken $refreshToken,
        OauthProviderName $provider,
    )
    {
        $this->accountId = $accountId;
        $this->displayName = $displayName;
        $this->avatar = $avatar;
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->provider = $provider;
    }

    /**
     * @return AccountId
     */
    public function accountId(): AccountId
    {
        return $this->accountId;
    }

    /**
     * @return DisplayName
     */
    public function displayName(): DisplayName
    {
        return $this->displayName;
    }

    /**
     * @return Avatar
     */
    public function avatar(): Avatar
    {
        return $this->avatar;
    }

    /**
     * @return AccessToken
     */
    public function accessToken(): AccessToken
    {
        return $this->accessToken;
    }

    /**
     * @return RefreshToken
     */
    public function refreshToken(): RefreshToken
    {
        return $this->refreshToken;
    }

    /**
     * @return OauthProviderName
     */
    public function provider(): OauthProviderName
    {
        return $this->provider;
    }
}
