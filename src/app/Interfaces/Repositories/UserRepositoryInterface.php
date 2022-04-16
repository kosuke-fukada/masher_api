<?php
declare(strict_types=1);

namespace App\Interfaces\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * @return User
     */
    public function signin(\App\Entities\User\User $user): User;
}
