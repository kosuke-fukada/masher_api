<?php
declare(strict_types=1);

namespace App\Interfaces\Usecases\RefreshTwitterAccessToken;

interface RefreshTwitterAccessTokenInterface
{
    /**
     * @return void
     */
    public function process(): void;
}
