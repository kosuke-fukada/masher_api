<?php
declare(strict_types=1);

namespace App\Usecases\User\SigninWithRememberToken;

use Throwable;
use App\Models\User;
use RuntimeException;
use App\Entities\User\UserInfo;
use App\ValueObjects\Foundation\StatusCode;
use App\Interfaces\Factories\User\UserFactoryInterface;
use App\Interfaces\Services\User\Signin\SetAuthSessionServiceInterface;
use App\Interfaces\Usecases\User\SigninWithRememberToken\SigninWithRememberTokenInputPort;
use App\Interfaces\Usecases\User\SigninWithRememberToken\SigninWithRememberTokenInterface;

class SigninWithRememberToken implements SigninWithRememberTokenInterface
{
    /**
     * @var User
     */
    private User $user;

    /**
     * @var UserFactoryInterface
     */
    private UserFactoryInterface $factory;

    /**
     * @var SetAuthSessionServiceInterface
     */
    private SetAuthSessionServiceInterface $setAuthSessionService;

    /**
     * @param User $user
     * @param UserFactoryInterface $factory
     * @param SetAuthSessionServiceInterface $setAuthSessionService
     */
    public function __construct(
        User $user,
        UserFactoryInterface $factory,
        SetAuthSessionServiceInterface $setAuthSessionService
    )
    {
        $this->user = $user;
        $this->factory = $factory;
        $this->setAuthSessionService = $setAuthSessionService;
    }

    /**
     * @param SigninWithRememberTokenInputPort $input
     * @return UserInfo|null
     */
    public function process(SigninWithRememberTokenInputPort $input): ?UserInfo
    {
        try {
            $authUser = $this->user->newQuery()
                ->where('remember_token', '=', (string)$input->rememberToken())
                ->first();

            if (is_null($authUser)) {
                return $authUser;
            }

            $signedInUser = $this->setAuthSessionService->process($authUser);
        } catch (Throwable $e) {
            $this->logger->error($e->getMessage());
            throw new RuntimeException('Failed to signin: ' . $e->getMessage(), StatusCode::STATUS_CODE_INTERNAL_SERVER_ERROR->value, $e);
        }

        return $this->factory->createUserInfoFromUserModel($signedInUser);
    }
}
