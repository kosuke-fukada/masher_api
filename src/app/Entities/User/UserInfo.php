<?php
declare(strict_types=1);

namespace App\Entities\User;

use App\ValueObjects\User\Avatar;
use App\ValueObjects\User\UserId;
use App\ValueObjects\User\ExpiresAt;
use App\ValueObjects\Shared\UserName;
use App\ValueObjects\Shared\AccountId;
use App\ValueObjects\User\AccessToken;
use App\ValueObjects\User\DisplayName;
use App\ValueObjects\User\RefreshToken;
use App\ValueObjects\User\OauthProviderName;

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
     * @var ExpiresAt|null
     */
    private ?ExpiresAt $expiresAt;

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
     * @param ExpiresAt|null $expiresAt
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
        ?ExpiresAt $expiresAt,
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
        $this->expiresAt = $expiresAt;
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
     * @return ExpiresAt|null
     */
    public function expiresAt(): ?ExpiresAt
    {
        return $this->expiresAt;
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
            'account_id' => (string)$this->accountId(),
            'user_name' => (string)$this->userName(),
            'display_name' => (string)$this->displayName(),
            'avatar' => (string)$this->avatar()
        ];
    }

    /**
     * @param UserName $userName
     * @return void
     */
    public function changeUserName(UserName $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @param DisplayName $displayName
     * @return void
     */
    public function changeDisplayName(DisplayName $displayName): void
    {
        $this->displayName = $displayName;
    }

    /**
     * @param Avatar $avatar
     * @return void
     */
    public function changeAvatar(Avatar $avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * @param AccessToken $accessToken
     * @return void
     */
    public function changeAccessToken(AccessToken $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @param RefreshToken $refreshToken
     * @return void
     */
    public function changeRefreshToken(RefreshToken $refreshToken): void
    {
        $this->refreshToken = $refreshToken;
    }

    /**
     * @param ExpiresAt $expiresAt
     * @return void
     */
    public function changeExpiresAt(ExpiresAt $expiresAt): void
    {
        $this->expiresAt = $expiresAt;
    }
}
