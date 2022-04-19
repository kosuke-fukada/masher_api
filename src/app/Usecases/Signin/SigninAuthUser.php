<?php
declare(strict_types=1);

namespace App\Usecases\Signin;

use App\Entities\User\UserInfo;
use App\Interfaces\Factories\User\UserFactoryInterface;
use App\Interfaces\Services\Signin\SetAuthSessionServiceInterface;
use App\Interfaces\Usecases\Signin\SigninAuthUserInterface;
use App\Models\User;
use App\ValueObjects\Foundation\StatusCode;
use App\ValueObjects\User\OauthProviderName;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
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
     * @param UserFactoryInterface $userFactory
     * @param SetAuthSessionServiceInterface $setAuthSessionService
     */
    public function __construct(
        UserFactoryInterface $userFactory,
        SetAuthSessionServiceInterface $setAuthSessionService
    )
    {
        $this->userFactory = $userFactory;
        $this->setAuthSessionService = $setAuthSessionService;
    }

    /**
     * @param OauthProviderName $oauthProviderName
     * @return UserInfo
     */
    public function process(OauthProviderName $oauthProviderName): UserInfo
    {
        $user = Socialite::driver($oauthProviderName->value)->user();

        DB::beginTransaction();
        try {
            // ログインセッション
            $userInstance = new User([
                'account_id' => $user->getId(),
                'display_name' => $user->getNickname(),
                'avatar' => $user->getAvatar(),
                'access_token' => $user->token,
                'refresh_token' => $user->refreshToken,
                'provider' => $oauthProviderName->value
            ]);
            $userId = $this->setAuthSessionService->process($userInstance);

            // Entityを作成
            $userEntity = $this->userFactory->createUserEntity(
                $userId,
                $user->getId(),
                $user->getNickname(),
                $user->getAvatar(),
                $user->token,
                $user->refreshToken,
                $oauthProviderName->value
            );

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw new RuntimeException('Failed to signin.', StatusCode::STATUS_CODE_INTERNAL_SERVER_ERROR->value, $e);
        }

        // ユーザーデータを返却
        return $userEntity;
    }
}
