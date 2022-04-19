<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\Signout;

interface SignoutInterface
{
    /**
     * @return void
     */
    public function process(): void;
}
