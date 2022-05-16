<?php
declare(strict_types=1);

namespace App\Usecases\User\SigninAuthUser;

use Throwable;
use App\Models\User;
use RuntimeException;
use Carbon\CarbonImmutable;
use Psr\Log\LoggerInterface;
use App\ValueObjects\User\Avatar;
use Illuminate\Support\Facades\DB;
use App\ValueObjects\User\ExpiresAt;
use App\ValueObjects\Shared\UserName;
use App\ValueObjects\Shared\AccountId;
use App\ValueObjects\User\AccessToken;
use App\ValueObjects\User\DisplayName;
use App\ValueObjects\User\RefreshToken;
use Laravel\Socialite\Facades\Socialite;
use App\ValueObjects\Foundation\StatusCode;
use App\ValueObjects\User\OauthProviderName;
use App\Interfaces\Factories\User\UserFactoryInterface;
use App\Interfaces\Repositories\User\UserRepositoryInterface;
use App\Interfaces\Services\User\Signin\SetAuthSessionServiceInterface;
use App\Interfaces\Usecases\User\SigninAuthUser\SigninAuthUserInterface;

class SigninAuthUser implements SigninAuthUserInterface
{
    /**
     * @var UserFactoryInterface
     */
    private UserFactoryInterface $userFactory;

    /**
     * @var SetAuthSessionServiceInterface
     */
    private SetAuthSessionServiceInterface $setAuthSessionService;

    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param UserFactoryInterface $userFactory
     * @param SetAuthSessionServiceInterface $setAuthSessionService
     * @param UserRepositoryInterface $userRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        UserFactoryInterface $userFactory,
        SetAuthSessionServiceInterface $setAuthSessionService,
        UserRepositoryInterface $userRepository,
        LoggerInterface $logger
    )
    {
        $this->userFactory = $userFactory;
        $this->setAuthSessionService = $setAuthSessionService;
        $this->userRepository = $userRepository;
        $this->logger = $logger;
    }

    /**
     * @param OauthProviderName $oauthProviderName
     * @return void
     */
    public function process(OauthProviderName $oauthProviderName): void
    {
        $user = Socialite::driver($oauthProviderName->value)->stateless()->user();

        DB::beginTransaction();
        try {
            $currentTime = new CarbonImmutable();
            $expiresAt = $currentTime->addSecond($user->expiresIn);
            // accountIdとproviderでユーザーを検索
            $providerAuthenticatededUser = $this->userRepository->findByAccountIdAndProvider(
                new AccountId($user->getId()),
                $oauthProviderName
            );
            if (is_null($providerAuthenticatededUser)) {
                // 新規ユーザー
                $providerAuthenticatededUser = new User([
                    'account_id' => $user->getId(),
                    'user_name' => $user->getNickname(),
                    'display_name' => $user->getName(),
                    'avatar' => $user->getAvatar(),
                    'access_token' => $user->token,
                    'refresh_token' => $user->refreshToken,
                    'expires_at' => $expiresAt->format('Y-m-d H:i:s'),
                    'provider' => $oauthProviderName->value
                ]);
            }
            $signedInUser = $this->setAuthSessionService->process($providerAuthenticatededUser);

            // サインイン済のUserオブジェクトからEntityを作成
            $userInfo = $this->userFactory->createUserInfoFromUserModel($signedInUser);

            // DBに保存されている値と異なる場合は更新
            $updated = false;
            if ((string)$userInfo->userName() !== $user->getNickname()) {
                $userInfo->changeUserName(new UserName($user->getNickname()));
                $updated = true;
            }
            if ((string)$userInfo->displayName() !== $user->getName()) {
                $userInfo->changeDisplayName(new DisplayName($user->getName()));
                $updated = true;
            }
            if ((string)$userInfo->avatar() !== $user->getAvatar()) {
                $userInfo->changeAvatar(new Avatar($user->getAvatar()));
                $updated = true;
            }
            if ((string)$userInfo->accessToken() !== $user->token) {
                $userInfo->changeAccessToken(new AccessToken($user->token));
                $updated = true;
            }
            if ((string)$userInfo->refreshToken() !== $user->refreshToken) {
                $userInfo->changeRefreshToken(new RefreshToken($user->refreshToken));
                $updated = true;
            }
            if ($userInfo->expiresAt()->toDate() !== $expiresAt->format('Y-m-d H:i:s')) {
                $userInfo->changeExpiresAt(new ExpiresAt($expiresAt));
                $updated = true;
            }
            if ($updated) {
                $this->userRepository->updateUser($userInfo);
            }

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            $this->logger->error($e->getMessage());
            throw new RuntimeException('Failed to signin: ' . $e->getMessage(), StatusCode::STATUS_CODE_INTERNAL_SERVER_ERROR->value, $e);
        }
    }
}
