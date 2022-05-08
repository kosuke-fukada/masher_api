<?php
declare(strict_types=1);

namespace App\Interfaces\Clients\GetTweet;

use Psr\Http\Message\UriInterface;
use Psr\Http\Message\RequestInterface;

interface GetTweetApiClientRequestInterface
{
    /**
     * @param RequestInterface $request
     * @return RequestInterface
     */
    public function toPsrRequest(RequestInterface $request): RequestInterface;

    /**
     * @param UriInterface $uri
     * @return UriInterface
     */
    public function endpointUri(UriInterface $uri): UriInterface;
}
