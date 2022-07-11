<?php
declare(strict_types=1);

namespace App\Clients\GetTweet;

use App\Entities\Tweet\Tweet;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\RequestInterface;
use Fig\Http\Message\RequestMethodInterface;
use App\Interfaces\Clients\GetTweet\GetTweetApiClientRequestInterface;
use App\ValueObjects\User\AccessToken;

class GetTweetApiClientRequest implements GetTweetApiClientRequestInterface
{
    /**
     * @var Tweet
     */
    private Tweet $tweet;

    /**
     * @var AccessToken
     */
    private AccessToken $accessToken;

    /**
     * @param Tweet $tweet
     * @param AccessToken $accessToken
     */
    public function __construct(
        Tweet $tweet,
        AccessToken $accessToken
    )
    {
        $this->tweet = $tweet;
        $this->accessToken = $accessToken;
    }

    /**
     * @param RequestInterface $request
     * @return RequestInterface
     */
    public function toPsrRequest(RequestInterface $request): RequestInterface
    {
        $request = $request->withMethod(RequestMethodInterface::METHOD_GET)
            ->withUri($this->endpointUri($request->getUri()))
            ->withHeader('Authorization', 'Bearer ' . (string)$this->accessToken);

        return $request;
    }

    /**
     * @param UriInterface $uri
     * @return UriInterface
     */
    public function endpointUri(UriInterface $uri): UriInterface
    {
        $query = 'user.fields=id,username,profile_image_url&tweet.fields=created_at&media.fields=url,variants&expansions=author_id,attachments.media_keys';
        return $uri->withPath('2/tweets/' . (string)$this->tweet->tweetId())
            ->withQuery($query);
    }
}
