<?php
declare(strict_types=1);

namespace App\Usecases\Signin;

use App\Interfaces\Factories\User\UserFactoryInterface;
use App\Interfaces\Repositories\User\UserRepositoryInterface;
use App\Interfaces\Services\Signin\SetAuthSessionServiceInterface;
use App\Interfaces\Usecases\Signin\SigninAuthUserInterface;
use App\Models\User;
use App\ValueObjects\Foundation\StatusCode;
use App\ValueObjects\User\AccessToken;
use App\ValueObjects\User\AccountId;
use App\ValueObjects\User\Avatar;
use App\ValueObjects\User\DisplayName;
use App\ValueObjects\User\ExpiresAt;
use App\ValueObjects\User\OauthProviderName;
use App\ValueObjects\User\RefreshToken;
use App\ValueObjects\User\UserName;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Psr\Log\LoggerInterface;
use RuntimeException;
use Throwable;

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
            // accountIdとproviderでユーザーを検索
            $authUser = $this->userRepository->findByAccountIdAndProvider(
                new AccountId($user->getId()),
                $oauthProviderName
            );
            if (is_null($authUser)) {
                // 新規ユーザー
                $authUser = new User([
                    'account_id' => $user->getId(),
                    'user_name' => $user->getNickname(),
                    'display_name' => $user->getName(),
                    'avatar' => $user->getAvatar(),
                    'access_token' => $user->token,
                    'refresh_token' => $user->refreshToken,
                    'expires_at' => time() + $user->expiresIn,
                    'provider' => $oauthProviderName->value
                ]);
            }
            $userId = $this->setAuthSessionService->process($authUser);

            // DBから取得してきたUserオブジェクトからEntityを作成
            $userInfo = $this->userFactory->createUserEntity(
                $userId,
                $authUser->getAttribute('account_id'),
                $authUser->getAttribute('user_name'),
                $authUser->getAttribute('display_name'),
                $authUser->getAttribute('avatar'),
                $authUser->getAttribute('access_token'),
                $authUser->getAttribute('refresh_token'),
                $authUser->getAttribute('expires_at'),
                $authUser->getAttribute('provider'),
            );

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
            if ($userInfo->expiresAt()->toInt() !== $user->expiresIn) {
                $userInfo->changeExpiresAt(new ExpiresAt(time() + $user->expiresIn));
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
