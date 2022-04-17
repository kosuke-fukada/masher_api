<?php
declare(strict_types=1);

namespace App\Interfaces\Services\Signin;

use App\Entities\User\User;

interface SigninUserServiceInterface
{
    /**
     * @param User $user
     * @return void
     */
    public function process(User $user): void;
}
