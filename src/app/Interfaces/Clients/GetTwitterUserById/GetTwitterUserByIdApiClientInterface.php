<?php
declare(strict_types=1);

namespace App\Interfaces\Clients\GetTwitterUserById;

interface GetTwitterUserByIdApiClientInterface
{
    /**
     * @param GetTwitterUserByIdApiClientRequestInterface $request
     * @return GetTwitterUserByIdApiClientResponseInterface
     */
    public function process(GetTwitterUserByIdApiClientRequestInterface $request): GetTwitterUserByIdApiClientResponseInterface;
}
