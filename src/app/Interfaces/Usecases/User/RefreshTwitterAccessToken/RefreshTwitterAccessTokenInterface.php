<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\User\RefreshTwitterAccessToken;

interface RefreshTwitterAccessTokenInterface
{
    /**
     * @return void
     */
    public function process(): void;
}
