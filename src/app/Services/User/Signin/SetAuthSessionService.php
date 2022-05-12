<?php
declare(strict_types=1);

namespace App\Services\User\Signin;

use App\Interfaces\Services\User\Signin\SetAuthSessionServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SetAuthSessionService implements SetAuthSessionServiceInterface
{
    /**
     * @param User $user
     * @return User
     */
    public function process(User $user): User
    {
        Auth::login($user, true);
        return Auth::user();
    }
}
