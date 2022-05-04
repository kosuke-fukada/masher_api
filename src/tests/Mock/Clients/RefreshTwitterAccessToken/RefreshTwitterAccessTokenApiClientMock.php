<?php
declare(strict_types=1);

namespace Tests\Mock\Clients\RefreshTwitterAccessToken;

use App\Interfaces\Clients\RefreshTwitterAccessToken\RefreshTwitterAccessTokenApiClientInterface;
use App\Interfaces\Clients\RefreshTwitterAccessToken\RefreshTwitterAccessTokenApiClientRequestInterface;
use App\Interfaces\Clients\RefreshTwitterAccessToken\RefreshTwitterAccessTokenApiClientResponseInterface;

class RefreshTwitterAccessTokenApiClientMock implements RefreshTwitterAccessTokenApiClientInterface
{
    /**
     * @param RefreshTwitterAccessTokenApiClientRequestInterface $request
     * @return RefreshTwitterAccessTokenApiClientResponseInterface
     */
    public function process(RefreshTwitterAccessTokenApiClientRequestInterface $request): RefreshTwitterAccessTokenApiClientResponseInterface
    {
        return new RefreshTwitterAccessTokenApiClientResponseMock();
    }
}
