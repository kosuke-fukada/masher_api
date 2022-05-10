<?php
declare(strict_types=1);

namespace App\Clients\GetTwitterLikeList;

use Psr\Http\Message\UriInterface;
use App\ValueObjects\Tweet\NextToken;
use App\ValueObjects\Shared\AccountId;
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
     * @var NextToken
     */
    private NextToken $nextToken;

    /**
     * @param AccountId $accountId
     * @param AccessToken $accessToken
     * @param NextToken $nextToken
     */
    public function __construct(
        AccountId $accountId,
        AccessToken $accessToken,
        NextToken $nextToken
    )
    {
        $this->accountId = $accountId;
        $this->accessToken = $accessToken;
        $this->nextToken = $nextToken;
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
        $query = 'user.fields=id,username&max_results=10&expansions=author_id';
        if ($this->nextToken->existNext()) {
            $query .= '&pagination_token=' . (string)$this->nextToken;
        }
        return $uri->withPath('2/users/' . (string)$this->accountId . '/liked_tweets')
            ->withQuery($query);
    }
}
