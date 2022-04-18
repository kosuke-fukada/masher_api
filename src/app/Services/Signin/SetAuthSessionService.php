<?php
declare(strict_types=1);

namespace App\Services\Signin;

use App\Interfaces\Services\Signin\SetAuthSessionServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SetAuthSessionService implements SetAuthSessionServiceInterface
{
    /**
     * @param User $user
     * @return void
     */
    public function process(User $user): int
    {
        Auth::login($user, true);
        return Auth::id();
    }
}
