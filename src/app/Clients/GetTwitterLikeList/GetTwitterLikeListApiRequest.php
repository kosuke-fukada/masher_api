<?php
declare(strict_types=1);

namespace App\Clients\GetTwitterLikeList;

use Psr\Http\Message\UriInterface;
use App\ValueObjects\User\AccountId;
use App\ValueObjects\User\AccessToken;
use Psr\Http\Message\RequestInterface;
use Fig\Http\Message\RequestMethodInterface;
use App\Interfaces\Clients\GetTwitterLikeList\GetTwitterLikeListApiClientRequestInterface;

class GetTwitterLikeListApiRequest implements GetTwitterLikeListApiClientRequestInterface
{
    /**
     * @var AccountId
     */
    private AccountId $accountId;

    /**
     * @var AccessToken
     */
    private AccessToken $accessToken;

    /**
     * @param AccountId $accountId
     * @param AccessToken $accessToken
     */
    public function __construct(
        AccountId $accountId,
        AccessToken $accessToken
    )
    {
        $this->accountId = $accountId;
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
        return $uri->withPath('users/' . (string)$this->accountId . '/liked_tweets')
            ->withQuery('?user.fields=id');
    }
}
