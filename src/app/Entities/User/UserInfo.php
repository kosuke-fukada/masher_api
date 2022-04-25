<?php
declare(strict_types=1);

namespace App\Entities\User;

use App\ValueObjects\User\Avatar;
use App\ValueObjects\User\AccountId;
use App\ValueObjects\User\AccessToken;
use App\ValueObjects\User\DisplayName;
use App\ValueObjects\User\RefreshToken;
use App\ValueObjects\User\OauthProviderName;
use App\ValueObjects\User\UserId;
use App\ValueObjects\User\UserName;

class UserInfo
{
    /**
     * @var UserId
     */
    private UserId $userId;

    /**
     * @var AccountId
     */
    private AccountId $accountId;

    /**
     * @var UserName
     */
    private UserName $userName;

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
     * @var RefreshToken|null
     */
    private ?RefreshToken $refreshToken;

    /**
     * @var OauthProviderName
     */
    private OauthProviderName $provider;

    /**
     * @param UserId $userId
     * @param AccountId $accountId
     * @param UserName $userName
     * @param DisplayName $displayName
     * @param Avatar $avatar
     * @param AccessToken $accessToken
     * @param RefreshToken|null $refreshToken
     * @param OauthProviderName $provider
     */
    public function __construct(
        UserId $userId,
        AccountId $accountId,
        UserName $userName,
        DisplayName $displayName,
        Avatar $avatar,
        AccessToken $accessToken,
        ?RefreshToken $refreshToken,
        OauthProviderName $provider,
    )
    {
        $this->userId = $userId;
        $this->accountId = $accountId;
        $this->userName = $userName;
        $this->displayName = $displayName;
        $this->avatar = $avatar;
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->provider = $provider;
    }

    /**
     * @return UserId
     */
    public function userId(): UserId
    {
        return $this->userId;
    }

    /**
     * @return AccountId
     */
    public function accountId(): AccountId
    {
        return $this->accountId;
    }

    /**
     * @return UserName
     */
    public function userName(): UserName
    {
        return $this->userName;
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
     * @return RefreshToken|null
     */
    public function refreshToken(): ?RefreshToken
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

    /**
     * @return array
     */
    public function toArrayWithoutCredentials(): array
    {
        return [
            'user_id' => $this->userId()->toInt(),
            'account_id' => $this->accountId()->toInt(),
            'user_name' => (string)$this->userName(),
            'display_name' => (string)$this->displayName(),
            'avatar' => (string)$this->avatar()
        ];
    }
}
