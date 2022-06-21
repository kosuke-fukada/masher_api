<?php
declare(strict_types=1);

namespace App\Clients\GetTwitterUserById;

use Psr\Http\Message\UriInterface;
use Psr\Http\Message\RequestInterface;
use Fig\Http\Message\RequestMethodInterface;
use App\Interfaces\Clients\GetTwitterUserById\GetTwitterUserByIdApiClientRequestInterface;
use App\ValueObjects\Tweet\AuthorId;
use App\ValueObjects\User\AccessToken;

class GetTwitterUserByIdApiClientRequest implements GetTwitterUserByIdApiClientRequestInterface
{
    /**
     * @var AuthorId
     */
    private AuthorId $authorId;

    /**
     * @var AccessToken
     */
    private AccessToken $accessToken;

    /**
     * @param AuthorId $authorId
     * @param AccessToken $accessToken
     */
    public function __construct(
        AuthorId $authorId,
        AccessToken $accessToken
    )
    {
        $this->authorId = $authorId;
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
        return $uri->withPath('2/users/' . (string)$this->authorId);
    }
}
