<?php
declare(strict_types=1);

namespace App\Interfaces\Clients\GetTwitterLikeList;

interface GetTwitterLikeListApiClientResponseInterface
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
