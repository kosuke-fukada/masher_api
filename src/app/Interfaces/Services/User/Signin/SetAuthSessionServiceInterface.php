<?php
declare(strict_types=1);

namespace App\Interfaces\Services\User\Signin;

use App\Models\User;

interface SetAuthSessionServiceInterface
{
    /**
     * @param User $user
     * @return User
     */
    public function process(User $user): User;
}
