<?php
declare(strict_types=1);

namespace App\Interfaces\Clients\GetTwitterLikeList;

interface GetTwitterLikeListApiClientInterface
{
    /**
     * @param GetTwitterLikeListApiClientRequestInterface $request
     * @return GetTwitterLikeListApiClientResponseInterface
     */
    public function process(GetTwitterLikeListApiClientRequestInterface $request): GetTwitterLikeListApiClientResponseInterface;
}
