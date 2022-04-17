<?php
declare(strict_types=1);

namespace App\Interfaces\Services\Signin;

use App\Models\User;

interface SetAuthSessionServiceInterface
{
    /**
     * @param User $user
     * @return void
     */
    public function process(User $user): void;
}
