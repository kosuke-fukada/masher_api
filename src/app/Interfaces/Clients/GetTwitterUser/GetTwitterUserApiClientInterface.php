<?php
declare(strict_types=1);

namespace App\Interfaces\Clients\GetTwitterUser;

interface GetTwitterUserApiClientInterface
{
    /**
     * @param GetTwitterUserApiClientRequestInterface $request
     * @return GetTwitterUserApiClientResponseInterface
     */
    public function process(GetTwitterUserApiClientRequestInterface $request): GetTwitterUserApiClientResponseInterface;
}
