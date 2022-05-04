<?php
declare(strict_types=1);

namespace App\Interfaces\Clients\RefreshTwitterAccessToken;

interface RefreshTwitterAccessTokenApiClientInterface
{
    /**
     * @param RefreshTwitterAccessTokenApiClientRequestInterface $request
     * @return RefreshTwitterAccessTokenApiClientResponseInterface
     */
    public function process(RefreshTwitterAccessTokenApiClientRequestInterface $request): RefreshTwitterAccessTokenApiClientResponseInterface;
}
