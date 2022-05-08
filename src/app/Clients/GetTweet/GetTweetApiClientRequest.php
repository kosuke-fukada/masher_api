<?php
declare(strict_types=1);

namespace App\Clients\GetTweet;

use App\Entities\Tweet\Tweet;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\RequestInterface;
use Fig\Http\Message\RequestMethodInterface;
use App\Interfaces\Clients\GetTweet\GetTweetApiClientRequestInterface;

class GetTweetApiClientRequest implements GetTweetApiClientRequestInterface
{
    /**
     * @var Tweet
     */
    private Tweet $tweet;

    /**
     * @param Tweet $tweet
     */
    public function __construct(Tweet $tweet)
    {
        $this->tweet = $tweet;
    }

    /**
     * @param RequestInterface $request
     * @return RequestInterface
     */
    public function toPsrRequest(RequestInterface $request): RequestInterface
    {
        $request = $request->withMethod(RequestMethodInterface::METHOD_GET)
            ->withUri($this->endpointUri($request->getUri()));

        return $request;
    }

    /**
     * @param UriInterface $uri
     * @return UriInterface
     */
    public function endpointUri(UriInterface $uri): UriInterface
    {
        return $uri->withPath('oembed')
            ->withQuery(http_build_query(['url' => $this->tweet->tweetUrl()]));
    }
}
