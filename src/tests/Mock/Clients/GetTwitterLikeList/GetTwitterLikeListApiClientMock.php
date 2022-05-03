<?php
declare(strict_types=1);

namespace Tests\Mock\Clients\GetTwitterLikeList;

use App\Interfaces\Clients\GetTwitterLikeList\GetTwitterLikeListApiClientInterface;
use App\Interfaces\Clients\GetTwitterLikeList\GetTwitterLikeListApiClientRequestInterface;
use App\Interfaces\Clients\GetTwitterLikeList\GetTwitterLikeListApiClientResponseInterface;

class GetTwitterLikeListApiClientMock implements GetTwitterLikeListApiClientInterface
{
    /**
     * @param GetTwitterLikeListApiClientRequestInterface $request
     * @return GetTwitterLikeListApiClientResponseInterface
     */
    public function process(GetTwitterLikeListApiClientRequestInterface $request): GetTwitterLikeListApiClientResponseInterface
    {
        return new GetTwitterLikeListApiResponseMock();
    }
}
