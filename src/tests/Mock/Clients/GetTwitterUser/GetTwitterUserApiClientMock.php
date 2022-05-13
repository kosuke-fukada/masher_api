<?php
declare(strict_types=1);

namespace Tests\Mock\Clients\GetTwitterUser;

use App\Interfaces\Clients\GetTwitterUser\GetTwitterUserApiClientInterface;
use App\Interfaces\Clients\GetTwitterUser\GetTwitterUserApiClientRequestInterface;
use App\Interfaces\Clients\GetTwitterUser\GetTwitterUserApiClientResponseInterface;

class GetTwitterUserApiClientMock implements GetTwitterUserApiClientInterface
{
    /**
     * @param GetTwitterUserApiClientRequestInterface $request
     * @return GetTwitterUserApiClientResponseInterface
     */
    public function process(GetTwitterUserApiClientRequestInterface $request): GetTwitterUserApiClientResponseInterface
    {
        return new GetTwitterUserApiClientResponseMock();
    }
}
