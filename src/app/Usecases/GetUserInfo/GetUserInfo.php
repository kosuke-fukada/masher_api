<?php
declare(strict_types=1);

namespace App\Usecases\GetUserInfo;

use App\Entities\User\UserInfo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\Factories\User\UserFactoryInterface;
use App\Interfaces\Usecases\GetUserInfo\GetUserInfoInterface;

class GetUserInfo implements GetUserInfoInterface
{
    /**
     * @var UserFactoryInterface
     */
    private UserFactoryInterface $factory;

    /**
     * @param UserFactoryInterface $factory
     */
    public function __construct(UserFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return UserInfo|null
     */
    public function process(): ?UserInfo
    {
        /** @var User $user */
        $user = Auth::user();

        // Entityを作成してreturn
        return is_null($user) ? $user :
            $this->factory->createUserEntity(
                $user->getAttribute('id'),
                $user->getAttribute('account_id'),
                $user->getAttribute('user_name'),
                $user->getAttribute('display_name'),
                $user->getAttribute('avatar'),
                $user->getAttribute('access_token'),
                $user->getAttribute('refresh_token'),
                (int)strtotime($user->getAttribute('expires_at')),
                $user->getAttribute('provider')
            );
    }
}
