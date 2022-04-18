<?php
declare(strict_types=1);

namespace App\Usecases\Signin;

use App\Exceptions\ExceptionBaseClass;
use App\Interfaces\Factories\User\UserFactoryInterface;
use App\Interfaces\Services\Signin\SetAuthSessionServiceInterface;
use App\Interfaces\Services\Signin\SigninUserServiceInterface;
use App\Interfaces\Usecases\Signin\SigninAuthUserInterface;
use App\Models\User;
use App\Models\UserInfo;
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
     * @var SigninUserServiceInterface
     */
    private SigninUserServiceInterface $signinUserService;

    /**
     * @var SetAuthSessionServiceInterface
     */
    private SetAuthSessionServiceInterface $setAuthSessionService;

    /**
     * @param UserFactoryInterface $userFactory
     * @param SigninUserServiceInterface $signinUserService
     * @param SetAuthSessionServiceInterface $setAuthSessionService
     */
    public function __construct(
        UserFactoryInterface $userFactory,
        SigninUserServiceInterface $signinUserService,
        SetAuthSessionServiceInterface $setAuthSessionService
    )
    {
        $this->userFactory = $userFactory;
        $this->signinUserService = $signinUserService;
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
            $userId = $this->setAuthSessionService->process(new User());

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

            // ユーザー情報が存在するかチェックして存在しない場合は作成
            $authUser = $this->signinUserService->process($userEntity);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw new RuntimeException('Failed to signin.', ExceptionBaseClass::STATUS_CODE_INTERNAL_SERVER_ERROR, $e);
        }

        // ユーザーデータを返却
        return $authUser;
    }
}
