<?php
declare(strict_types=1);

namespace App\Interfaces\Clients\RefreshTwitterAccessToken;

interface RefreshTwitterAccessTokenApiClientResponseInterface
{
    /**
     * @return string
     */
    public function contents(): string;

    /**
     * @return integer
     */
    public function getStatusCode(): int;
}
