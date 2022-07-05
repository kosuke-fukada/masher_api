<?php
declare(strict_types=1);

namespace App\Usecases\User\SigninWithRememberToken;

use App\Entities\User\UserInfo;
use App\Interfaces\Factories\User\UserFactoryInterface;
use App\Interfaces\Usecases\User\SigninWithRememberToken\SigninWithRememberTokenInputPort;
use App\Interfaces\Usecases\User\SigninWithRememberToken\SigninWithRememberTokenInterface;
use App\Models\User;

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
     * @param User $user
     * @param UserFactoryInterface $factory
     */
    public function __construct(
        User $user,
        UserFactoryInterface $factory
    )
    {
        $this->user = $user;
        $this->factory = $factory;
    }

    /**
     * @param SigninWithRememberTokenInputPort $input
     * @return UserInfo|null
     */
    public function process(SigninWithRememberTokenInputPort $input): ?UserInfo
    {
        $authUser = $this->user->newQuery()
            ->where('remember_token', '=', (string)$input->rememberToken())
            ->first();

        return is_null($authUser) ? $authUser : $this->factory->createUserInfoFromUserModel($authUser);
    }
}
