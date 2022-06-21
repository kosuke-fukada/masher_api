<?php
declare(strict_types=1);

namespace Tests\Mock\Clients\GetTwitterUserById;

use App\Interfaces\Clients\GetTwitterUserById\GetTwitterUserByIdApiClientInterface;
use App\Interfaces\Clients\GetTwitterUserById\GetTwitterUserByIdApiClientRequestInterface;
use App\Interfaces\Clients\GetTwitterUserById\GetTwitterUserByIdApiClientResponseInterface;

class GetTwitterUserByIdApiClientMock implements GetTwitterUserByIdApiClientInterface
{
    /**
     * @param GetTwitterUserByIdApiClientRequestInterface $request
     * @return GetTwitterUserByIdApiClientResponseInterface
     */
    public function process(GetTwitterUserByIdApiClientRequestInterface $request): GetTwitterUserByIdApiClientResponseInterface
    {
        return new GetTwitterUserByIdApiClientResponseMock();
    }
}
