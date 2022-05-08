<?php
declare(strict_types=1);

namespace Tests\Mock\Clients\GetTweet;

use App\Interfaces\Clients\GetTweet\GetTweetApiClientInterface;
use App\Interfaces\Clients\GetTweet\GetTweetApiClientRequestInterface;
use App\Interfaces\Clients\GetTweet\GetTweetApiClientResponseInterface;

class GetTweetApiClientMock implements GetTweetApiClientInterface
{
    /**
     * @param GetTweetApiClientRequestInterface $request
     * @return GetTweetApiClientResponseInterface
     */
    public function process(GetTweetApiClientRequestInterface $request): GetTweetApiClientResponseInterface
    {
        return new GetTweetApiClientResponseMock();
    }
}
