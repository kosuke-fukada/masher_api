<?php
declare(strict_types=1);

namespace App\Usecases\Signout;

use App\Interfaces\Usecases\Signout\SignoutInterface;
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
