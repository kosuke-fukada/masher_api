<?php
declare(strict_types=1);

namespace App\Usecases\User\Signout;

use App\Interfaces\Usecases\User\Signout\SignoutInterface;
use Illuminate\Support\Facades\Auth;

class Signout implements SignoutInterface
{
    /**
     * @return void
     */
    public function process(): void
    {
        Auth::logout();
    }
}
