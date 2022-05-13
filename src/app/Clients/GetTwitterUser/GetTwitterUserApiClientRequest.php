<?php
declare(strict_types=1);

namespace App\Clients\GetTwitterUser;

use Psr\Http\Message\UriInterface;
use Psr\Http\Message\RequestInterface;
use Fig\Http\Message\RequestMethodInterface;
use App\Interfaces\Clients\GetTwitterUser\GetTwitterUserApiClientRequestInterface;
use App\ValueObjects\Shared\UserName;
use App\ValueObjects\User\AccessToken;

class GetTwitterUserApiClientRequest implements GetTwitterUserApiClientRequestInterface
{
    /**
     * @var UserName
     */
    private UserName $userName;

    /**
     * @var AccessToken
     */
    private AccessToken $accessToken;

    /**
     * @param UserName $userName
     * @param AccessToken $accessToken
     */
    public function __construct(
        UserName $userName,
        AccessToken $accessToken
    )
    {
        $this->userName = $userName;
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
        return $uri->withPath('2/users/by/username' . (string)$this->userName);
    }
}
