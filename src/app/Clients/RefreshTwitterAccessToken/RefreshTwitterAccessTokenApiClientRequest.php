<?php
declare(strict_types=1);

namespace App\Clients\RefreshTwitterAccessToken;

use Psr\Http\Message\UriInterface;
use Psr\Http\Message\RequestInterface;
use Fig\Http\Message\RequestMethodInterface;
use App\Interfaces\Clients\RefreshTwitterAccessToken\RefreshTwitterAccessTokenApiClientRequestInterface;
use App\ValueObjects\User\RefreshToken;

class RefreshTwitterAccessTokenApiClientRequest implements RefreshTwitterAccessTokenApiClientRequestInterface
{
    private const GRANT_TYPE = 'refresh_token';

    /**
     * @var RefreshToken
     */
    private RefreshToken $refreshToken;

    /**
     * @param RefreshToken $refreshToken
     */
    public function __construct(RefreshToken $refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    /**
     * @param RequestInterface $request
     * @return RequestInterface
     */
    public function toPsrRequest(RequestInterface $request): RequestInterface
    {
        $request = $request->withMethod(RequestMethodInterface::METHOD_POST)
            ->withUri($this->endpointUri($request->getUri()));
        $request->getBody()
            ->write(http_build_query(
                [
                    'refresh_token' => (string)$this->refreshToken,
                    'grant_type' => self::GRANT_TYPE,
                ]
            ));

        return $request;
    }

    /**
     * @param UriInterface $uri
     * @return UriInterface
     */
    public function endpointUri(UriInterface $uri): UriInterface
    {
        return $uri->withPath('2/oauth2/token');
    }
}
