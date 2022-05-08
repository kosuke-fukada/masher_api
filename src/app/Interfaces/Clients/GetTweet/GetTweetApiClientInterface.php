<?php
declare(strict_types=1);

namespace App\Interfaces\Clients\GetTweet;

interface GetTweetApiClientInterface
{
    /**
     * @param GetTweetApiClientRequestInterface $request
     * @return GetTweetApiClientResponseInterface
     */
    public function process(GetTweetApiClientRequestInterface $request): GetTweetApiClientResponseInterface;
}
